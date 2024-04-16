<?php

namespace App\Http\Controllers;

use App\Core\Configurator;
use App\Core\UpdateManager;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use VulcanPhp\Core\Database\Schema\Schema;

class Admin
{
    protected Configurator $config;

    public function __construct()
    {
        // set configurator
        $this->config = Configurator::$instance;

        // check configuration
        if (!$this->config->isConfigured()) {
            if (request()->isPostBack() && !empty(input('password')) && input('password') == input('confirm')) {
                $this->createTables();

                $this->config->setup([
                    'password' => password(input('password')),
                ]);

                response()->back();
            } else {
                echo view('admin.configure');
                exit;
            }
        }

        // check login
        if (!session('logged', false)) {
            if (request()->isPostBack() && password(input('password'), $this->config->get('password'))) {
                session()->set('logged', true);
                response()->back();
            } else {
                echo view('admin.login');
                exit;
            }
        }
    }

    public function index()
    {
        if (!empty(input('action'))) {
            $this->handleAction(input('action'));
            return response()->back();
        }

        $cat_filter     = null;
        $product_filter = null;
        $order_filter   = null;
        $payment_filter = null;

        if (!empty(input('search-cat'))) {
            $cat_filter = "title LIKE '%" . input('search-cat') . "%'";
        }

        if (!empty(input('search-product'))) {
            $product_filter = "title LIKE '%" . input('search-product') . "%' OR id = '" . input('search-product') . "'";
        }

        if (!empty(input('search-order'))) {
            $order_filter = "email = '" . input('search-order') . "' OR phone = '" . input('search-order') . "' OR id = '" . input('search-order') . "'";
        }

        if (!empty(input('search-payment'))) {
            $payment_filter = "payment_id = '" . input('search-payment') . "' OR order_id = '" . input('search-payment') . "'";
        }

        return view('admin.index', [
            'config' => $this->config,
            'category' => Category::where($cat_filter)->order('p.id DESC')->paginate(10, 'category'),
            'product' => Product::where($product_filter)->order('p.id DESC')->paginate(10, 'product'),
            'order' => Order::where($order_filter)->order('p.id DESC')->paginate(10, 'order'),
            'cat_list' => Category::select('id, title')->order('id DESC')->get()->mapWithKeys(fn ($cat) => [$cat->id => $cat->title])->all(),
            'payment' => Payment::where($payment_filter)->order('id DESC')->paginate(10, 'payment')
        ]);
    }

    protected function handleAction(string $action): void
    {
        $callback = match ($action) {
            'feature' => fn () => $this->config->setup([
                'password' => !empty(trim(input('password', ''))) ? password(input('password')) : $this->config->get('password')
            ]),
            'update-check' => fn () => UpdateManager::check(),
            'update-download' => fn () => UpdateManager::download(),
            'remove-donate' => fn () => $this->config->set('remove-donate', true),
            'settings' => function () {
                $setup = input()->all(['title', 'tagline', 'description', 'copyright', 'language', 'currency', 'vat', 'shipping', 'paypal_environment', 'paypal_client_id', 'paypal_client_secret', 'stripe_publishable_key', 'stripe_secret_key', 'head', 'body', 'footer']);
                $setup['paypal_enabled'] = input('paypal_enabled') == 'on';
                $setup['stripe_enabled'] = input('stripe_enabled') == 'on';
                $setup['cod_enabled']    = input('cod_enabled') == 'on';

                return $this->config->setup($setup);
            },
            'category' => fn () => (new Category)->input()->save(),
            'product' => fn () => (new Product)->input()->save(),
            'order' => fn () => (new Order)->input()->save(),
            'payment' => fn () => (new Payment)->input()->save(),
            'delete-order' => fn () => Order::erase(['id' => input('id')]),
            'delete-payment' => fn () => Payment::erase(['id' => input('id')]),
            'delete-category' => function () {
                $category = Category::find(input('id'));

                if (isset($category->image)) {
                    unlink(storage_dir($category->image));
                }

                return $category->remove();
            },
            'delete-product' => function () {
                $product = Product::find(input('id'));

                if (isset($product->image)) {
                    $product->deleteImages();
                }

                return $product->remove();
            },
            default => fn () => null
        };

        call_user_func($callback);
    }

    protected function createTables(): void
    {
        // create option table
        db()->exec(
            Schema::create('options')
                ->string('name', 200)->primary()->unique()
                ->string('value', 255)->nullable()
                ->build()
        );


        // create category tables
        db()->exec(
            Schema::create('categories')
                ->id()
                ->string('title', 100)->key('category')
                ->string('image', 255)->nullable()
                ->build()
        );

        // create product table
        db()->exec(
            Schema::create('products')
                ->id()
                ->string('title', 200)->key('product')
                ->foreignId('category')->constrained('categories', 'id')->onUpdate('cascade')->onDelete('cascade')
                ->decimal('price', '6,2')
                ->integer('quantity')->nullable()
                ->string('image', 255)->nullable()
                ->text('description')->nullable()
                ->build()
        );

        // create order table
        db()->exec(
            Schema::create('orders')
                ->id()
                ->string('name', 100)->nullable()
                ->string('email', 80)->key('email')->nullable()
                ->string('phone', 40)->key('phone')->nullable()
                ->string('address', 255)->nullable()
                ->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'canceled'])->default('pending')
                ->timestamp('ordered_at')
                ->build()
        );

        // create payment table
        db()->exec(
            Schema::create('payments')
                ->id()
                ->foreignId('order_id')->constrained('orders', 'id')->onUpdate('cascade')->onDelete('cascade')
                ->decimal('subtotal', '6,2')
                ->decimal('total', '6,2')
                ->string('method', 50)->key('payment_method')
                ->string('payment_id', 255)->key('payment_id')
                ->enum('status', ['pending', 'processing', 'unpaid', 'paid', 'canceled'])->default('pending')
                ->timestamp('created_at')
                ->build()
        );

        // create ordered_items table
        db()->exec(
            Schema::create('orderitems')
                ->id()
                ->foreignId('order_id')->constrained('orders', 'id')->onUpdate('cascade')->onDelete('cascade')
                ->foreignId('product_id')->constrained('products', 'id')->onUpdate('cascade')->onDelete('cascade')
                ->integer('quantity', 6)->default(1)
                ->build()
        );
    }
}
