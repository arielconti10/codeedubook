<?php

namespace CodeEduBook\Models;

use CodeEduBook\Models\Category;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Entities\Book
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book whereSubtitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book whereUserId($value)
 * @mixin \Eloquent
 */
class Book extends Model implements TableInterface
{
    use FormAccessible;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'author_id'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function author()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function formCategoriesAttribute(){
        return $this->categories->pluck('id')->all();
    }

    public function getTableHeaders()
    {
        return ['#', 'Titulo', 'Subtitulo', 'Preço', 'Usuário'];
    }

    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#' :
                return $this->id;
            case 'Titulo' :
                return $this->title;
            case 'Subtitulo' :
                return $this->subtitle;
            case 'Preço' :
                return $this->price;
            case 'Usuário' :
                return $this->author->name;
            break;
        }
    }


}
