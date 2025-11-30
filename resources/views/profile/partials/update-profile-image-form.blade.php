<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your profile picture. Maximum file size: 2MB.") }}
        </p>
    </header>

    <!-- Current Image Display -->
    @if(Auth::user()->image)
    <div class="mt-4">
        <p class="text-sm font-medium text-gray-700 mb-2">Current Profile Picture:</p>
        <img src="{{ asset('storage/' . Auth::user()->image) }}"
            alt="Current profile picture"
            class="rounded-lg"
            style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #e5e7eb;">
    </div>
    @else
    <div class="mt-4">
        <p class="text-sm font-medium text-gray-700 mb-2">No profile picture uploaded yet</p>
        <div style="width: 150px; height: 150px; border-radius: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 48px; border: 2px solid #e5e7eb;">
            {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
        </div>
    </div>
    @endif

    <form method="post" action="{{ route('profile.update-image') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="image" :value="__('Choose New Image')" />
            <input id="image"
                name="image"
                type="file"
                class="mt-1 block w-full"
                accept="image/*"
                onchange="previewImage(event)" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
            <p class="mt-1 text-sm text-gray-600">Accepted formats: JPG, PNG, GIF (Max: 2MB)</p>
        </div>

        <!-- Image Preview -->
        <div id="imagePreview" style="display: none;">
            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
            <img id="preview"
                src=""
                alt="Preview"
                class="rounded-lg"
                style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #667eea;">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                id="uploadBtn"
                disabled
                style="padding: 10px 20px; 
                   background-color: #6b7280; 
                   color: white; 
                   border: none; 
                   border-radius: 6px; 
                   font-weight: 600; 
                   cursor: not-allowed;
                   opacity: 0.5;">
                {{ __('Upload Image') }}
            </button>

            @if (session('image-updated') === 'true')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <!-- Delete Image Form -->
    @if(Auth::user()->image)
    <form method="post" action="{{ route('profile.delete-image') }}" class="mt-6">
        @csrf
        @method('delete')

        <x-danger-button
            type="submit"
            onclick="return confirm('Are you sure you want to delete your profile picture?')">
            {{ __('Delete Profile Picture') }}
        </x-danger-button>
    </form>
    @endif

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const uploadBtn = document.getElementById('uploadBtn');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';

                    // Enable and style the button
                    uploadBtn.disabled = false;
                    uploadBtn.style.backgroundColor = '#667eea';
                    uploadBtn.style.cursor = 'pointer';
                    uploadBtn.style.opacity = '1';
                }
                reader.readAsDataURL(file);
            } else {
                // Disable and gray out the button
                uploadBtn.disabled = true;
                uploadBtn.style.backgroundColor = '#6b7280';
                uploadBtn.style.cursor = 'not-allowed';
                uploadBtn.style.opacity = '0.5';
            }
        }
    </script>
</section>