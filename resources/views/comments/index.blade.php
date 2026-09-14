<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 40px; background-color: #f4f4f9;">

    <div style="max-width: 600px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        
        <h1 style="color: #333; margin-bottom: 30px; font-size: 28px;">Edit Comment</h1>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Comment Text:</label>
                
                <!-- old() pehle priority lega, warna existing comment text dikhayega -->
                <textarea name="comment_text" rows="5" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px; box-sizing: border-box; resize: vertical;" required>{{ old('comment_text', $comment->comment_text) }}</textarea>
                
                @error('comment_text')
                    <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" style="background-color: #007bff; color: white; padding: 14px 28px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; font-weight: bold; width: 100%;">Update Comment</button>

            <a href="{{ route('comments.index', $comment->post_id) }}" style="display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none;">Cancel</a>

        </form>
    </div>

</body>
</html>