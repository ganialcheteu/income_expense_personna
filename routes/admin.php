<?php

use App\Http\Controllers\admin\activityController;
use App\Http\Controllers\admin\customerController;
use App\Http\Controllers\admin\customerTypeController;
use App\Http\Controllers\admin\expenseCategoryController;
use App\Http\Controllers\admin\expenseController;
use App\Http\Controllers\admin\expenseTypeController;
use App\Http\Controllers\admin\incomeCategoryController;
use App\Http\Controllers\admin\incomeController;
use App\Http\Controllers\admin\incomeTypeController;
use App\Http\Controllers\admin\loginController;
use App\Http\Controllers\admin\PasswordNewController;
use App\Http\Controllers\admin\registerController;
use App\Http\Controllers\admin\ResetPasswordController;
use App\Http\Controllers\admin\supplierController;
use App\Http\Controllers\admin\UserController;
use App\Http\Middleware\CheckIfUserIsActive;
use App\Http\Middleware\CheckIfUserIsSuperAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('register', [registerController::class, 'create'])
        ->name('register');

    Route::post('register', [registerController::class, 'store']);

    Route::get('login', [loginController::class, 'create'])
        ->name('login');

    Route::get('forgot-password', [ResetPasswordController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [ResetPasswordController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [PasswordNewController::class, 'create'])->name('password.reset');

    Route::post('reset-password', [PasswordNewController::class, 'store'])
        ->name('password.store');

});

Route::middleware(['auth', 'verified', CheckIfUserIsActive::class])->group(function () {

    //return users list
    Route::get('/dashboard', [loginController::class, 'dashboard'])->name('dashboard');

    //change status
    Route::post('/user/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('user.toggleStatus');

    //redirection login apres logout
    Route::post('logout', [loginController::class, 'destroy'])
        ->name('logout');
    //income category
    Route::get('incomes_categories', [incomeCategoryController::class, 'index'])->name('incomes_categories');

    //income type
    Route::get('incomes_types', [incomeTypeController::class, 'index'])->name('incomes_types');

    //expense type
    Route::get('expenses_types', [expenseTypeController::class, 'index'])->name('expenses_types');

    //expense category
    Route::get('expenses_categories', [expenseCategoryController::class, 'index'])->name('expenses_categories');

    //customer type
    Route::get('customers_types', [customerTypeController::class, 'index'])->name('customers_types');

    //suppliers
    Route::get('suppliers', [supplierController::class, 'index'])->name('suppliers');

    //customers
    Route::get('customers', [customerController::class, 'index'])->name('customers');

    //activities
    Route::get('activities', [activityController::class, 'index'])->name('activities');
    Route::get('activities/activity_show/{slug}', [activityController::class, 'show'])->name('activities/activity_show');

    //incomes
    Route::get('incomes', [incomeController::class, 'index'])->name('incomes');
    Route::get('incomes/income_show/{slug}', [incomeController::class, 'show'])->name('incomes/income_show');

    //expenses
    Route::get('expenses', [expenseController::class, 'index'])->name('expenses');
    Route::get('expenses/expense_show/{slug}', [expenseController::class, 'show'])->name('expenses/expense_show');

});

Route::middleware(['auth', 'verified', CheckIfUserIsActive::class, CheckIfUserIsSuperAdmin::class])->group(function () {

    // ONLY SUPER ADMIN CAN ACCESS

    Route::get('incomes_categories/income_category_create', [incomeCategoryController::class, 'create'])->name('incomes_categories/income_category_create');
    Route::post('incomes_categories/income_category_store', [incomeCategoryController::class, 'store'])->name('incomes_categories/income_category_store');
    Route::post('incomes_categories/income_category_destroy/{slug}', [incomeCategoryController::class, 'destroy'])->name('incomes_categories/income_category_destroy');
    Route::get('incomes_categories/income_category_edit/{slug}', [incomeCategoryController::class, 'edit'])->name('incomes_categories/income_category_edit');
    Route::post('incomes_categories/income_category_update/{slug}', [incomeCategoryController::class, 'update'])->name('incomes_categories/income_category_update');

    Route::get('incomes_types/income_type_create', [incomeTypeController::class, 'create'])->name('incomes_types/income_type_create');
    Route::post('incomes_types/income_type_store', [incomeTypeController::class, 'store'])->name('incomes_types/income_type_store');
    Route::post('incomes_types/income_type_destroy/{slug}', [incomeTypeController::class, 'destroy'])->name('incomes_types/income_type_destroy');
    Route::get('incomes_types/income_type_edit/{slug}', [incomeTypeController::class, 'edit'])->name('incomes_types/income_type_edit');
    Route::post('incomes_types/income_type_update/{slug}', [incomeTypeController::class, 'update'])->name('incomes_types/income_type_update');

    Route::get('expenses_types/expense_type_create', [expenseTypeController::class, 'create'])->name('expenses_types/expense_type_create');
    Route::post('expenses_types/expense_type_store', [expenseTypeController::class, 'store'])->name('expenses_types/expense_type_store');
    Route::post('expenses_types/expense_type_destroy/{slug}', [expenseTypeController::class, 'destroy'])->name('expenses_types/expense_type_destroy');
    Route::get('expenses_types/expense_type_edit/{slug}', [expenseTypeController::class, 'edit'])->name('expenses_types/expense_type_edit');
    Route::post('expenses_types/expense_type_update/{slug}', [expenseTypeController::class, 'update'])->name('expenses_types/expense_type_update');

    Route::get('expenses_categories/expense_category_create', [expenseCategoryController::class, 'create'])->name('expenses_categories/expense_category_create');
    Route::post('expenses_categories/expense_category_store', [expenseCategoryController::class, 'store'])->name('expenses_categories/expense_category_store');
    Route::post('expenses_categories/expense_category_destroy/{slug}', [expenseCategoryController::class, 'destroy'])->name('expenses_categories/expense_category_destroy');
    Route::get('expenses_categories/expense_category_edit/{slug}', [expenseCategoryController::class, 'edit'])->name('expenses_categories/expense_category_edit');
    Route::post('expenses_categories/expense_category_update/{slug}', [expenseCategoryController::class, 'update'])->name('expenses_categories/expense_category_update');

    Route::get('customers_types/customer_type_create', [customerTypeController::class, 'create'])->name('customers_types/customer_type_create');
    Route::post('customers_types/customer_type_store', [customerTypeController::class, 'store'])->name('customers_types/customer_type_store');
    Route::post('customers_types/customer_type_destroy/{slug}', [customerTypeController::class, 'destroy'])->name('customers_types/customer_type_destroy');
    Route::get('customers_types/customer_type_edit/{slug}', [customerTypeController::class, 'edit'])->name('customers_types/customer_type_edit');
    Route::post('customers_types/customer_type_update/{slug}', [customerTypeController::class, 'update'])->name('customers_types/customer_type_update');

    Route::get('suppliers/supplier_create', [supplierController::class, 'create'])->name('suppliers/supplier_create');
    Route::post('suppliers/supplier_store', [supplierController::class, 'store'])->name('suppliers/supplier_store');
    Route::post('suppliers/supplier_destroy/{slug}', [supplierController::class, 'destroy'])->name('suppliers/supplier_destroy');
    Route::get('suppliers/supplier_edit/{slug}', [supplierController::class, 'edit'])->name('suppliers/supplier_edit');
    Route::post('suppliers/supplier_update/{slug}', [supplierController::class, 'update'])->name('suppliers/supplier_update');

    Route::get('customers/customer_create', [customerController::class, 'create'])->name('customers/customer_create');
    Route::post('customers/customer_store', [customerController::class, 'store'])->name('customers/customer_store');
    Route::post('customers/customer_destroy/{slug}', [customerController::class, 'destroy'])->name('customers/customer_destroy');
    Route::get('customers/customer_edit/{slug}', [customerController::class, 'edit'])->name('customers/customer_edit');
    Route::post('customers/customer_update/{slug}', [customerController::class, 'update'])->name('customers/customer_update');

    Route::get('activities/activity_create', [activityController::class, 'create'])->name('activities/activity_create');
    Route::post('activities/activity_store', [activityController::class, 'store'])->name('activities/activity_store');
    Route::post('activities/activity_destroy/{slug}', [activityController::class, 'destroy'])->name('activities/activity_destroy');
    Route::get('activities/activity_edit/{slug}', [activityController::class, 'edit'])->name('activities/activity_edit');
    Route::post('activities/activity_update/{slug}', [activityController::class, 'update'])->name('activities/activity_update');

    Route::get('incomes/income_create', [incomeController::class, 'create'])->name('incomes/income_create');
    Route::post('incomes/income_store', [incomeController::class, 'store'])->name('incomes/income_store');
    Route::post('incomes/income_destroy/{slug}', [incomeController::class, 'destroy'])->name('incomes/income_destroy');
    Route::get('incomes/income_edit/{slug}', [incomeController::class, 'edit'])->name('incomes/income_edit');
    Route::post('incomes/income_update/{slug}', [incomeController::class, 'update'])->name('incomes/income_update');

    Route::get('expenses/expense_create', [expenseController::class, 'create'])->name('expenses/expense_create');
    Route::post('expenses/expense_store', [expenseController::class, 'store'])->name('expenses/expense_store');
    Route::post('expenses/expense_destroy/{slug}', [expenseController::class, 'destroy'])->name('expenses/expense_destroy');
    Route::get('expenses/expense_edit/{slug}', [expenseController::class, 'edit'])->name('expenses/expense_edit');
    Route::post('expenses/expense_update/{slug}', [expenseController::class, 'update'])->name('expenses/expense_update');
});
