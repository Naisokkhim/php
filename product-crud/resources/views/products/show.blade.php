<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md text-center">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Product Details</h1>
        <p class="text-gray-600"><strong>Name:</strong> {{ $product->name }}</p>
        <p class="text-gray-600"><strong>Description:</strong> {{ $product->description }}</p>
        <p class="text-gray-600"><strong>Price:</strong> ${{ $product->price }}</p>
        <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">Back to List</a>
    </div>
</body>
</html>
