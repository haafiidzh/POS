<?php

namespace Modules\Front\Livewire\Course\Show;

use Exception;
use Livewire\Component;
use Modules\Customer\Models\Customer;
use Modules\Course\Models\CourseReview;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Front\Livewire\Course\Show;

class WriteReview extends Component
{
    use  WithThirdParty, FlashMessage;

    /**
     * Define string props
     * @var ?string
     */
    public ?string  $course_id = '';
    public ?string  $customer_id = '';
    public ?string  $message = '';

    /**
     * Define int props
     * @var ?int
     */
    public ?int $rating = 0;

    /**
     * Define validation rules
     * @var array
     */
    public function rules()
    {
        return [
            'message' => 'nullable|min:10|max:200',
            'rating' => 'required|numeric|min:1|max:5',
        ];
    }

    /**
     * Define validation messages
     * @var array
     */
    protected $messages = [
        '*.required' => ':attribute tidak boleh kosong.',
        'message.min' => ':attribute min. :min karakter.',
        'message.max' => ':attribute maks. :max karakter.',
        'rating.min' => ':attribute min. :min.',
        'rating.max' => ':attribute maks. :max.',
        '*.numeric' => ':attribute hanya diperbolehkan numeric.',
    ];

    /**
     * Define validation attribute aliases
     * @var array
     */
    protected $validationAttributes = [
        'message' => 'ulasan',
        'rating' => 'rating',
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount($course_id, $customer_id)
    {
        $this->course_id = $course_id;
        $this->customer_id = $customer_id;
    }

    /**
     * Store customer review
     * @return void
     */
    public function store()
    {
        $this->validate();

        try {
            CourseReview::create([
                'course_id' => $this->course_id,
                'customer_id' => $this->customer_id,
                'rating' => $this->rating,
                'message' => $this->message,
            ]);

            $this->reset('rating', 'message');
            $this->dispatch('createdReview');

            return $this->dispatchSuccess('Review berhasil ditambahkan.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('front::livewire.course.show.write-review');
    }
}
