# Introduction

This package allows you to filter, sort and include eloquent relations based on a request. The QueryFilter used in this package extends Laravel's default Eloquent builder. This means all your favorite methods and macros are still available.

## Installation

Follow the steps below to install the package.
### Composer
```
composer require samushi/queryfilter
```

## Basic usage

### Before pre-usage
Create Filters, in this example we will create basic filter, just to understand how you can create filter

**Step 1**  
Create directory inside app folder and rename Filters, and then create Search.php file:

**Step 2** copy and past code:
```php
namespace App\Filters;
use Samushi\QueryFilter\Filter;

class Search extends Filter
{
    /**
     * Search Result by whereLike
     * @param $builder
     * @return mixed
     */
    protected function applyFilter($builder)
    {
        // if you wanna search with realtionship [name, 'posts.title']
        return $builder->whereLike(['name'], $this->getValue());
    }
}
```

**Note** Filter name and requested parameter needs to be the same name, in this example we use Search class name also `request()->input('search')` the parameter need to be the same name.

### 
```php
namespace App\Http\Controllers;

use App\User;
use App\Filters\Search;

class UserController extends Controller
{
    public function index()
    {
        $filters = [
            Search::class,
        ];

        return QueryFilter::query(User::newQuery(), $filters)->paginate(10);
    }
}
``` 

Please dont forget to rate :heart_eyes:
