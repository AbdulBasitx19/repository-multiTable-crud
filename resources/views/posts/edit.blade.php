<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 40px; background-color: #f4f4f9;">

    <div style="max-width: 700px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        
        <h1 style="color: #333; margin-bottom: 30px; font-size: 28px;">Edit Post</h1>

        <!-- Form: PUT request /posts/{id} par jayega -->
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- TITLE FIELD -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Title:</label>
                <!-- old() pehle priority leta hai (agar validation fail hui ho), warna $post->title dikhayega -->
                <input type="text" name="title" value="{{ old('title', $post->title) }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px; box-sizing: border-box;" required>
                
                @error('title')
                    <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- DESCRIPTION FIELD -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Description:</label>
                <textarea name="description" rows="5" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px; box-sizing: border-box; resize: vertical;">{{ old('description', $post->description) }}</textarea>
                
                @error('description')
                    <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- TAGS SELECTION -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Select Tags:</label>
                <div style="display: flex; flex-wrap: wrap; gap: 10px; padding: 15px; background-color: #f9f9f9; border-radius: 4px; border: 1px solid #ddd;">
                    
                    @foreach($tags as $tag)
                        <!-- 
                            $post->tags->contains($tag->id) check karta hai ke kya yeh tag is post se already attached hai.
                            Agar haan, toh 'checked' attribute add ho jayega.
                        -->
                        <label style="display: flex; align-items: center; cursor: pointer; padding: 5px 10px; background-color: white; border-radius: 4px; border: 1px solid #ddd;">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                @if($post->tags->contains($tag->id)) checked @endif 
                                style="margin-right: 8px; transform: scale(1.2);">
                            <span style="font-size: 14px;">{{ $tag->name }}</span>
                        </label>
                    @endforeach

                    @if($tags->isEmpty())
                        <p style="color: #999; font-size: 14px; margin: 0;">
                            No tags available. <a href="{{ route('tags.create') }}" style="color: #007bff;">Create a tag first</a>
                        </p>
                    @endif
                    
                </div>

                @error('tags')
                    <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
                @error('tags.*')
                    <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit" style="background-color: #007bff; color: white; padding: 14px 28px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; font-weight: bold; width: 100%;">Update Post</button>

            <a href="{{ route('posts.index') }}" style="display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none;">Cancel</a>

        </form>
    </div>

</body>
</html>