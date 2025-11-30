<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Create New Team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form method="POST" action="{{ route('teams.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Team Logo Upload -->
                        <div style="margin-bottom: 20px;">
                            <label for="image" style="display: block; font-weight: 600; margin-bottom: 8px; color: #e5e7eb;">
                                Team Logo (Optional)
                            </label>
                            <input type="file" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   style="display: block; 
                                          width: 100%; 
                                          padding: 10px; 
                                          background-color: #4b5563; 
                                          border: 1px solid #6b7280; 
                                          border-radius: 6px; 
                                          color: #e5e7eb;
                                          cursor: pointer;"
                                   onchange="previewImage(event)">
                            <p style="margin-top: 4px; font-size: 12px; color: #9ca3af;">
                                Recommended: Square image, max 2MB (JPG, PNG, GIF)
                            </p>
                            @error('image')
                                <p style="margin-top: 4px; font-size: 14px; color: #ef4444;">{{ $message }}</p>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" style="margin-top: 12px; display: none;">
                                <img id="preview" 
                                     src="" 
                                     alt="Preview" 
                                     style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px; border: 2px solid #6b7280;">
                            </div>
                        </div>

                        <!-- Team Name (First Part) -->
                        <div style="margin-bottom: 20px;">
                            <label for="first_name" style="display: block; font-weight: 600; margin-bottom: 8px; color: #e5e7eb;">
                                Team Name (First Part) *
                            </label>
                            <input type="text" 
                                   id="first_name" 
                                   name="first_name" 
                                   value="{{ old('first_name') }}"
                                   required
                                   placeholder="e.g., Los Angeles"
                                   style="display: block; 
                                          width: 100%; 
                                          padding: 10px; 
                                          background-color: #4b5563; 
                                          border: 1px solid #6b7280; 
                                          border-radius: 6px; 
                                          color: #e5e7eb;">
                            @error('first_name')
                                <p style="margin-top: 4px; font-size: 14px; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Team Name (Second Part) -->
                        <div style="margin-bottom: 20px;">
                            <label for="last_name" style="display: block; font-weight: 600; margin-bottom: 8px; color: #e5e7eb;">
                                Team Name (Second Part) *
                            </label>
                            <input type="text" 
                                   id="last_name" 
                                   name="last_name" 
                                   value="{{ old('last_name') }}"
                                   required
                                   placeholder="e.g., Lakers"
                                   style="display: block; 
                                          width: 100%; 
                                          padding: 10px; 
                                          background-color: #4b5563; 
                                          border: 1px solid #6b7280; 
                                          border-radius: 6px; 
                                          color: #e5e7eb;">
                            @error('last_name')
                                <p style="margin-top: 4px; font-size: 14px; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Founded Date -->
                        <div style="margin-bottom: 20px;">
                            <label for="date_of_birth" style="display: block; font-weight: 600; margin-bottom: 8px; color: #e5e7eb;">
                                Founded Date *
                            </label>
                            <input type="date" 
                                   id="date_of_birth" 
                                   name="date_of_birth" 
                                   value="{{ old('date_of_birth') }}"
                                   required
                                   style="display: block; 
                                          width: 100%; 
                                          padding: 10px; 
                                          background-color: #4b5563; 
                                          border: 1px solid #6b7280; 
                                          border-radius: 6px; 
                                          color: #e5e7eb;">
                            @error('date_of_birth')
                                <p style="margin-top: 4px; font-size: 14px; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div style="margin-bottom: 20px;">
                            <label for="email" style="display: block; font-weight: 600; margin-bottom: 8px; color: #e5e7eb;">
                                Team Email *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required
                                   placeholder="team@example.com"
                                   style="display: block; 
                                          width: 100%; 
                                          padding: 10px; 
                                          background-color: #4b5563; 
                                          border: 1px solid #6b7280; 
                                          border-radius: 6px; 
                                          color: #e5e7eb;">
                            @error('email')
                                <p style="margin-top: 4px; font-size: 14px; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div style="margin-bottom: 20px;">
                            <label for="password" style="display: block; font-weight: 600; margin-bottom: 8px; color: #e5e7eb;">
                                Password *
                            </label>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   required
                                   style="display: block; 
                                          width: 100%; 
                                          padding: 10px; 
                                          background-color: #4b5563; 
                                          border: 1px solid #6b7280; 
                                          border-radius: 6px; 
                                          color: #e5e7eb;">
                            @error('password')
                                <p style="margin-top: 4px; font-size: 14px; color: #ef4444;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div style="margin-bottom: 24px;">
                            <label for="password_confirmation" style="display: block; font-weight: 600; margin-bottom: 8px; color: #e5e7eb;">
                                Confirm Password *
                            </label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   style="display: block; 
                                          width: 100%; 
                                          padding: 10px; 
                                          background-color: #4b5563; 
                                          border: 1px solid #6b7280; 
                                          border-radius: 6px; 
                                          color: #e5e7eb;">
                        </div>

                        <!-- Buttons -->
                        <div style="display: flex; gap: 12px; justify-content: flex-end;">
                            <a href="{{ route('teams.index') }}" 
                               style="display: inline-block; 
                                      padding: 10px 20px; 
                                      background-color: #6b7280;
                                      color: white; 
                                      text-decoration: none; 
                                      border-radius: 6px; 
                                      font-weight: 600; 
                                      font-size: 14px;
                                      transition: all 0.3s ease;"
                               onmouseover="this.style.backgroundColor='#4b5563';"
                               onmouseout="this.style.backgroundColor='#6b7280';">
                                Cancel
                            </a>
                            <button type="submit"
                                    style="padding: 10px 20px; 
                                           background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                           color: white; 
                                           border: none;
                                           border-radius: 6px; 
                                           font-weight: 600; 
                                           font-size: 14px;
                                           cursor: pointer;
                                           transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                Create Team
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
