<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex">

    <aside class="w-64 min-h-screen bg-purple-900 text-white flex-shrink-0">
        <div class="p-6 text-2xl font-bold border-b border-purple-800">
            Reserva<span class="text-purple-400">Admin</span>
        </div>
        
        <nav class="mt-8 px-4">
            <a href="#" class="flex items-center py-3 px-4 bg-purple-800 rounded-lg mb-2">
                <i class="fas fa-chart-line mr-3"></i> Dashboard
            </a>
            <a href="#" class="flex items-center py-3 px-4 hover:bg-purple-800 rounded-lg mb-2 transition">
                <i class="fas fa-utensils mr-3"></i> Restaurants
            </a>
            <a href="#" class="flex items-center py-3 px-4 hover:bg-purple-800 rounded-lg mb-2 transition border-l-4 border-purple-400">
                <i class="fas fa-calendar-check mr-3"></i> Réservations
            </a>
            <a href="#" class="flex items-center py-3 px-4 hover:bg-purple-800 rounded-lg mb-2 transition">
                <i class="fas fa-users mr-3"></i> Utilisateurs
            </a>
            <div class="mt-10 border-t border-purple-800 pt-4">
                <a href="#" class="flex items-center py-3 px-4 text-purple-300 hover:text-white transition">
                    <i class="fas fa-sign-out-alt mr-3"></i> Déconnexion
                </a>
            </div>
        </nav>
    </aside>

    <main class="flex-1">
        <header class="bg-white shadow-sm py-4 px-8 flex justify-between items-center">
            <div class="text-gray-500 italic">Bienvenue, Administrateur</div>
            <div class="flex items-center">
                <span class="mr-4 font-semibold text-purple-900">{{ auth()->user()->name ?? 'Admin' }}</span>
                <div class="w-10 h-10 bg-purple-200 rounded-full flex items-center justify-center text-purple-700">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </header>

        <div class="p-8">
            @yield('content')
        </div>
    </main>

</body>
</html>