    <?php

    use App\Http\Controllers\Admin\Auth\loginController;
    use App\Http\Controllers\Admin\Auth\logoutController;
    use App\Http\Controllers\Admin\Auth\registerController;
    use App\Http\Controllers\Admin\Post\PostController as PostPostController;
    use App\Http\Controllers\mainController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\UserController;
    use App\Http\Middleware\RedirectIfAuthenticated;
    use Illuminate\Support\Facades\Route; /* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "web" middleware group. Make something great! | */

    Route::middleware(['preventBackHistory'])->group(function () {
        Route::get('/admin/login', [loginController::class, 'index'])->name('login')->middleware(RedirectIfAuthenticated::class);
        Route::post('/admin/login/store', [loginController::class, 'store'])->name('loginPost');
    });

    Route::get('/admin/register', [registerController::class, 'index'])->name('register')->middleware(RedirectIfAuthenticated::class);
    Route::post('admin/register/store', [registerController::class, 'store'])->name('registerPost');



    Route::middleware(['auth'])->group(function () {
        Route::resource('/user', UserController::class);

        Route::prefix('admin')->group(function () {
            Route::get('/', [mainController::class, 'index'])->name('admin');
            Route::get('/logout', [logoutController::class, 'logout'])->name('logout');

            Route::middleware(['auth', 'redirect.role:Admin'])->group(function () {
                Route::prefix('post')->group(function () {
                    Route::get('/new', [PostPostController::class, 'index'])->name('newPost');
                    Route::post('/new/store', [PostPostController::class, 'store'])->name('addPost');
                });
            });

            Route::middleware(['auth', 'redirect.role:Admin edit'])->group(function () {
                Route::prefix('post')->group(function () {
                    Route::get('/showall', [PostPostController::class, 'show'])->name('showAll');
                    Route::delete('/delete/{id}', [PostPostController::class, 'destroy'])->name('deletePost');
                    Route::delete('/deleteThumbnail/{id}', [PostPostController::class, 'deleteThumbnail'])->name('deleteThumbnail');
                    Route::delete('/deleteImage/{id}', [PostPostController::class, 'deleteImage'])->name('deleteImage');
                    Route::get('/edit/{id}', [PostPostController::class, 'edit'])->name('editPost');
                    Route::put('/update/{id}', [PostPostController::class, 'update'])->name('updatePost');
                });
            });
        });
    });
