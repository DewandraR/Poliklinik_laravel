<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Poliklinik BK</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl overflow-hidden">
        <div class="p-8 sm:p-10">
            <!-- Header -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-extrabold text-gray-800">Profile</h2>
                <p class="text-sm text-gray-500">Kelola informasi profil Anda</p>
            </div>

            <!-- Content -->
            <div class="space-y-6">
                <!-- Update Profile Information -->
                <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100 border border-gray-200 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Update Profile Information</h3>
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100 border border-gray-200 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Update Password</h3>
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete User -->
                <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100 border border-gray-200 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Delete User</h3>
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-blue-50 text-center py-4">
            <p class="text-sm text-gray-500">Kembali ke <a href="{{ route('dashboard') }}" class="text-blue-600 font-medium hover:underline">Dashboard</a></p>
        </div>
    </div>
</body>
</html>
