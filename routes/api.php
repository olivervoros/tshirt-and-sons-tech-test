<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\NoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
# 1. Create and edit contacts
Route::post('/contacts', [ContactController::class, 'create']);
Route::put('/contacts/{contactId}', [ContactController::class, 'edit']);

# 2. Retrieve a paginated list of all contacts
Route::get('/contacts', [ContactController::class, 'all']);

# 3. Retrieve a single contact
Route::get('/contacts/{contactId}', [ContactController::class, 'get']);

# 4. Can store multiple contacts for the same company
Route::post('/multiple-contacts/{companyId}', [ContactController::class, 'storeMultipleContactsForACompany']);

# 5. Store notes against a contact
Route::post('/add-notes/{contactId}', [NoteController::class, 'addNotes']);

# 6. List all contacts at a given company
Route::get('/list-all-contacts-for-a-company/{companyId}', [ContactController::class, 'listByCompanyId']);

# 7. List all companies
Route::get('/companies', [CompanyController::class, 'all']);

# 8. Search for contacts by name or company
Route::get('/search-for-contact-by-company/{companyName}', [ContactController::class, 'searchByCompanyName']);
Route::get('/search-for-contact-by-name/{contactName}', [ContactController::class, 'searchByContactName']);

