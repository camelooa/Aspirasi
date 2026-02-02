@extends('layout.siswa')

@section('content')
<div class="min-h-screen py-10 bg-cyan-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Submit Your Feedback</h1>
                        <p class="text-gray-600 mt-1">We value your input and would love to hear from you.</p>
                    </div>
                </div>

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('siswa.aspirasi.store') }}" method="POST" enctype="multipart/form-data" id="feedbackForm">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name feedback</label>
                            <input type="text" name="feedback_title" placeholder="name feedback" value="{{ old('feedback_title') }}" class="mt-2 block w-full border border-gray-200 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Feedback Category</label>
                            <select name="category_id" class="mt-2 block w-full border border-gray-200 rounded-md px-4 py-3 bg-white" required>
                                <option value="">Select a category</option>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Your Feedback</label>
                        <textarea name="details" id="details" rows="8" placeholder="Share your thoughts, suggestions, or concerns with us..." class="mt-2 block w-full border border-gray-200 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('details') }}</textarea>
                        <div class="mt-2 text-sm text-gray-500" id="charCount">0 characters</div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Upload image (optional)</label>
                            <input type="file" name="image" accept="image/*" class="mt-2 block w-full">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                            Submit Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // character counter for details textarea
        (function(){
            var details = document.getElementById('details');
            var counter = document.getElementById('charCount');
            if(!details) return;
            function updateCount(){
                var len = details.value.length;
                counter.textContent = len + ' characters';
            }
            details.addEventListener('input', updateCount);
            updateCount();
        })();
    </script>
</div>
@endsection
