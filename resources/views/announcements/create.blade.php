<!-- resources/views/announcements/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Announcement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-xl font-bold text-gray-800">Create New Announcement</div>
                <a href="{{ route('announcements.index') }}" 
                   class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times text-xl"></i>
                </a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                            <select name="program" required 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @foreach($programs as $program)
                                <option value="{{ $program }}">{{ $program }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Announcement Title</label>
                        <input type="text" name="title" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                        <textarea name="content" required rows="6"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Media Upload</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                <input type="file" name="media" accept="image/*,video/*" class="hidden" id="media-upload">
                                <label for="media-upload" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-500">Click to upload image or video</p>
                                </label>
                                <div id="preview" class="mt-4 hidden">
                                    <img id="image-preview" class="max-h-40 mx-auto hidden" alt="Preview">
                                    <video id="video-preview" class="max-h-40 mx-auto hidden" controls></video>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Video Length (if applicable)</label>
                            <input type="number" name="video_length" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Duration in seconds">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Target Date</label>
                            <input type="date" name="target_date" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Display Duration (days)</label>
                            <input type="number" name="display_duration" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Digital Signature</label>
                        <input type="text" name="digital_signature" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Type your full name as signature">
                    </div>

                    <div class="flex justify-end gap-4 mt-8">
                        <a href="{{ route('announcements.index') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center gap-2">
                            <i class="fas fa-paper-plane"></i>
                            Submit Announcement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Media upload preview functionality
        const mediaUpload = document.getElementById('media-upload');
        const imagePreview = document.getElementById('image-preview');
        const videoPreview = document.getElementById('video-preview');
        const preview = document.getElementById('preview');

        mediaUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const fileType = file.type.split('/')[0];
            const reader = new FileReader();

            // Hide both previews initially
            imagePreview.classList.add('hidden');
            videoPreview.classList.add('hidden');
            
            reader.onload = function(e) {
                preview.classList.remove('hidden');
                
                if (fileType === 'image') {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                } else if (fileType === 'video') {
                    videoPreview.src = e.target.result;
                    videoPreview.classList.remove('hidden');
                }
            }

            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>