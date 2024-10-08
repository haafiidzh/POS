<?php

namespace Modules\Front\Livewire\Pos;

use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Modules\Common\Services\Repositories\ProductRepo;
use Modules\Common\Traits\Utils\FlashMessage;
use Livewire\WithPagination;
use Modules\Common\Constants\Utilities;
use Modules\Common\Models\Category;
use stdClass;
use Modules\Common\Contracts\WithRemoveModal;
use Modules\Common\Models\Product;

class Pos extends Component
{

    use WithPagination, WithRemoveModal, FlashMessage;
    /**
     * Get all featured faq
     * @return Paginator
     */


    public string $category = '';
    public string $type = '';
    public string $status = '';
    public string $sort = 'created_at';
    public string $order = 'desc';
    public string $search = '';
    public string $partner = '';
    public string $creator = '';



    public string $destroyId = '';

    public $products = [];
    public $cart = [];
    public $total = 0;
    public $cash = 0;
    public $change = 0;



    /**
     * Defines int props
     * @var int
     */
    public int $per_page = 12;

    /**
     * Defines array property
     * @var array
     */
    protected array $queryString = [
        'search',
    ];

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        self::CANCEL,
        self::DESTROY,
    ];


    
    public function setCart($amount)
    {
        $item = Product::where('id', $amount)->first();

        // Ensure product exists
        if (!$item) {
            return;
        }

        // Fetch the cart from the session
        $cart = session()->get('cart', []);

        // Check if the item already exists in the cart, then increase the quantity
        if (isset($cart[$amount])) {
            $cart[$amount]['quantity']++;
        } else {
            // Add new item to cart
            $cart[$amount] = [
                'name' => $item->title,
                'price' => $item->price,
                'quantity' => 1,
            ];
        }



        // Save the cart to the session and update the Livewire component
        session()->put('cart', $cart);
        $this->cart = $cart;
        $this->updateTotal();
    }


    public function addToCart($itemId)
    {
        $item = Product::where('id', $itemId)->first();


        // Ensure product exists
        if (!$item) {
            return;
        }

        // Fetch the cart from the session
        $cart = session()->get('cart', []);

        // Check if the item already exists in the cart, then increase the quantity
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity']++;
        } else {
            // Add new item to cart
            $cart[$itemId] = [
                'name' => $item->title,
                'price' => $item->price,
                'quantity' => 1,
            ];
        }



        // Save the cart to the session and update the Livewire component
        session()->put('cart', $cart);
        $this->cart = $cart;
        $this->updateTotal();
    }

    public function removeFromCart($itemId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
        }

        session()->put('cart', $cart);
        $this->cart = $cart;
        $this->updateTotal();
    }

    private function updateTotal()
    {
        $this->total = array_reduce($this->cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        
    }

    

    public function mount()
    {
        // Initialize the cart from the session
        $this->cart = session()->get('cart', []);
        $this->updateTotal();
    }


    public function incrementQuantity($productId)
    {
        $this->cart[$productId]['quantity']++;
        session()->put('cart', $this->cart);  // Update session
        $this->updateTotal();
    }

    public function decrementQuantity($productId)
    {
        if ($this->cart[$productId]['quantity'] > 1) {
            $this->cart[$productId]['quantity']--;
        } else {
            $this->removeFromCart($productId);
        }
        session()->put('cart', $this->cart);  // Update session
        $this->updateTotal();
    }

    public function testAction()
    {
        dd('Button clicked!');
    }


    public function setCash($amount)
    {
        $this->cash = $amount;
        $this->calculateChange();
    }
    public function calculateChange()
    {
        $this->change = $this->cash - $this->total;
    }

    public function getAll()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Determine the value of 'user_id' based on the user's role
        $userId = $user->hasRole(['Mitra'], 'web')  ? $user->id : null;

        return (new ProductRepo())->filters((object) [
            'category' => $this->category,
            'type' => $this->type,
            'status' => $this->status,
            'author' => null,
            'sort' => $this->sort,
            'order' => $this->order,
            'search' => $this->search,
            'creator' => $this->creator,
            'user_id' => $userId, // Set 'user_id' based on the user's role
        ], $this->per_page);
    }

    public function getCategories()
    {
        $prepend = new stdClass;
        $prepend->name = 'Semua Kategori';
        $prepend->slug = null;

        return Category::select(['name', 'slug'])
            ->where(function ($category) {
                $category->has('parent')
                    ->orDoesntHave('childs');
            })
            ->where('group', 'like', '%products%')
            ->get()
            ->prepend(($prepend));
    }


    public function render()
    {
        return view('front::livewire.pos.pos', [
            'datas' => self::getAll(),
            'categories' => self::getCategories(),
        ]);
    }
}
