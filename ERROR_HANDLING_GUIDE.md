# Error Handling System Documentation

## Overview
This Laravel application now includes a comprehensive error handling system that provides consistent error responses for both web and API requests, with proper logging, validation, and user-friendly error messages.

## Components

### 1. Exception Handler (`app/Exceptions/Handler.php`)
- **Purpose**: Centralized exception handling for the entire application
- **Features**:
  - Separate handling for API and web requests
  - Custom error responses for different exception types
  - Comprehensive logging with context
  - User-friendly error messages in Arabic

### 2. Form Request Classes
- **Location**: `app/Http/Requests/`
- **Files**:
  - `StoreOfferRequest.php` - Validation for creating offers
  - `UpdateOfferRequest.php` - Validation for updating offers
  - `StoreProductRequest.php` - Validation for creating products
  - `UpdateProductRequest.php` - Validation for updating products
- **Features**:
  - Centralized validation rules
  - Custom error messages in Arabic
  - Attribute name translations

### 3. Custom Exception Class (`app/Exceptions/CustomException.php`)
- **Purpose**: Custom exception with user-friendly messages and error codes
- **Features**:
  - Separate user messages from technical messages
  - Error codes for API responses
  - Automatic response rendering

### 4. API Response Trait (`app/Traits/ApiResponse.php`)
- **Purpose**: Consistent API response formatting
- **Methods**:
  - `successResponse()` - Success responses
  - `errorResponse()` - General error responses
  - `validationErrorResponse()` - Validation errors
  - `notFoundResponse()` - 404 errors
  - `unauthorizedResponse()` - 401 errors
  - `forbiddenResponse()` - 403 errors
  - `serverErrorResponse()` - 500 errors

### 5. API Error Handler Middleware (`app/Http/Middleware/ApiErrorHandler.php`)
- **Purpose**: Catch and handle API-specific errors
- **Features**:
  - Logs API errors with context
  - Returns consistent JSON error responses
  - Handles uncaught exceptions

### 6. Custom Error Pages
- **Location**: `resources/views/errors/`
- **Files**:
  - `404.blade.php` - Not found page
  - `405.blade.php` - Method not allowed page
- **Features**:
  - Beautiful, responsive design
  - Arabic language support
  - RTL layout

## Error Handling Features

### Database Transactions
- All database operations are wrapped in transactions
- Automatic rollback on errors
- Prevents partial data corruption

### Comprehensive Logging
- All errors are logged with context
- Includes file, line, and stack trace
- Separate logging for different error types

### Validation Error Handling
- Custom validation messages in Arabic
- Proper error display for both web and API
- Input preservation on validation errors

### File Upload Error Handling
- Image upload validation
- File storage error handling
- Automatic cleanup on errors

### API vs Web Response Handling
- Controllers detect request type automatically
- Different response formats for API and web
- Consistent error structure across the application

## Usage Examples

### Web Request Error Handling
```php
// In controller
try {
    $product = Product::create($request->validated());
    return redirect()->route('products.index')->with('success', 'تم إنشاء المنتج بنجاح.');
} catch (Exception $e) {
    Log::error('Error creating product: ' . $e->getMessage());
    return redirect()->back()->with('error', 'حدث خطأ في إنشاء المنتج.');
}
```

### API Request Error Handling
```php
// In controller
try {
    $product = Product::create($request->validated());
    return $this->successResponse($product, 'تم إنشاء المنتج بنجاح', 201);
} catch (Exception $e) {
    Log::error('Error creating product: ' . $e->getMessage());
    return $this->serverErrorResponse('حدث خطأ في إنشاء المنتج');
}
```

### Custom Exception Usage
```php
throw new CustomException(
    'Database connection failed',
    500,
    null,
    'حدث خطأ في الاتصال بقاعدة البيانات',
    'DB_CONNECTION_ERROR'
);
```

## Error Response Formats

### Web Error Response
- Redirects with flash messages
- Preserves user input
- Shows validation errors inline

### API Error Response
```json
{
    "success": false,
    "message": "حدث خطأ في إنشاء المنتج",
    "error_code": "DB_CONNECTION_ERROR"
}
```

### API Success Response
```json
{
    "success": true,
    "message": "تم إنشاء المنتج بنجاح",
    "data": {
        "id": 1,
        "name": "Product Name",
        "created_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

## Configuration

### Middleware Registration
The API error handler middleware is registered in `app/Http/Kernel.php`:
```php
'api.error' => \App\Http\Middleware\ApiErrorHandler::class,
```

### Route Configuration
API routes use the error handler middleware:
```php
Route::middleware('api.error')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('offers', OffersController::class);
});
```

## Best Practices

1. **Always use try-catch blocks** for database operations
2. **Use Form Request classes** for validation
3. **Log errors with context** for debugging
4. **Provide user-friendly messages** in Arabic
5. **Use database transactions** for data integrity
6. **Handle both API and web requests** in controllers
7. **Clean up resources** (like uploaded files) on errors

## Testing Error Handling

### Test API Endpoints
```bash
# Test validation error
curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{"name": ""}'

# Test server error
curl -X GET http://localhost:8000/api/products/999
```

### Test Web Endpoints
- Visit non-existent pages to test 404 handling
- Submit invalid forms to test validation
- Test file upload errors

## Monitoring and Debugging

### Log Files
- Check `storage/logs/laravel.log` for error details
- Look for context information in log entries

### Debug Mode
- Set `APP_DEBUG=true` in `.env` for detailed error information
- Set `APP_DEBUG=false` in production for security

## Security Considerations

1. **Don't expose sensitive information** in error messages
2. **Log errors securely** without exposing user data
3. **Use proper HTTP status codes** for different error types
4. **Validate all input** before processing
5. **Handle file uploads securely** with proper validation

This error handling system provides a robust foundation for handling errors gracefully while maintaining a good user experience and proper logging for debugging.
