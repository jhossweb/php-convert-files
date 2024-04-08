<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Convert File </title>

    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4 min-w-[320px]">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Subir Archivo</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Selecciona un archivo:</label>
                <input type="file" id="file" name="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div class="mb-4">
                <label for="format" class="block text-sm font-medium text-gray-700">Tipo de archivo:</label>
                <select id="format" name="format" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="pdf">PDF</option>
                    <option value="word">Word</option>
                </select>
            </div>
            
            <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-50">Subir</button>
        </form>
    </div>
</body>
</html>
