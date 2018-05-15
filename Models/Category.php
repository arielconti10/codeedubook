<?php

namespace CodeEduBook\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEduBook\Models\Book;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Entities\Category
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model implements TableInterface
{
    use SoftDeletes;
    use FormAccessible;


    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books(){
        return $this->belongsToMany(Book::class);
    }

    public function getNameTrashedAttribute(){
        return $this->trashed() ? "{$this->name} (Inativa)" : $this->name;
    }

    /**
     * @return array
     */
    public function getTableHeaders()
    {
     return ['#', 'Nome'];
    }

    /**
     * @param string $header
     * @return int|string
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#' :
                return $this->id;
            case 'Nome' :
                return $this->name;
            break;
        }
    }


}
