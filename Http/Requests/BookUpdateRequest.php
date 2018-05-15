<?php

namespace CodeEduBook\Http\Requests;

use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Http\Requests\BookCreateRequest;
use Illuminate\Support\Facades\Auth;

class BookUpdateRequest extends BookCreateRequest
{
     private $repository;

     public function __construct(BookRepository $repository)
     {
         $this->repository = $repository;
     }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $book = $this->route('book');

        if($book->id == 0){
            return false;
        }

        return $book->author_id == \Auth::user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $book = $this->route('book');
        $id = $book ? $book->id : null;

        return [
            'title' => "required|max:255",
            'subtitle' => 'required|max:255',
            'price' => 'required|numeric'
        ];
    }
}
