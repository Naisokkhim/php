<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Edit Product</h1>
        <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-gray-600">Name:</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label for="description" class="block text-gray-600">Description:</label>
                <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">{{ $product->description }}</textarea>
            </div>
            <div>
                <label for="price" class="block text-gray-600">Price:</label>
                <input type="number" name="price" id="price" value="{{ $product->price }}" step="0.01" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg shadow-md hover:bg-blue-600 transition">Update</button>
        </form>
    </div>
</body>
</html>
