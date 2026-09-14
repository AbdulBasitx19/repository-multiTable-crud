<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 40px; background-color: #f4f4f9;">

    <div style="max-width: 700px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        
        <h1 style="color: #333; margin-bottom: 30px; font-size: 28px;">Create New Post</h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            
            @if ($errors->any())
                <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <strong>Validation Errors:</strong>
                    <ul style="margin: 10px 0 0 20px; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Hidden User ID (Hardcoded for now) -->
            <input type="hidden" name="user_id" value="1">

            <!-- TITLE FIELD -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Title:</label>
                <input type="text" name="title" value="{{ old('title') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px; box-sizing: border-box;" required>
                
                @error('title')
                    <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- DESCRIPTION FIELD -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Description:</label>
                <textarea name="description" rows="5" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px; box-sizing: border-box; resize: vertical;">{{ old('description') }}</textarea>
                
                @error('description')
                    <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- TAGS SELECTION -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Select Tags:</label>
                <div style="display: flex; flex-wrap: wrap; gap: 10px; padding: 15px; background-color: #f9f9f9; border-radius: 4px; border: 1px solid #ddd;">
                    
                    @foreach($tags as $tag)
                        <label style="display: flex; align-items: center; cursor: pointer; padding: 5px 10px; background-color: white; border-radius: 4px; border: 1px solid #ddd;">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" style="margin-right: 8px; transform: scale(1.2);">
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

            <!-- COMMENTS SECTION -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Add Comments (Optional):</label>
                <p style="font-size: 13px; color: #666; margin-bottom: 10px;">Click "Add Comment" button to add multiple comments.</p>

                <div id="comments-container"></div>

                <button type="button" onclick="addCommentField()" style="background-color: #17a2b8; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; margin-top: 10px;">+ Add Comment</button>

                @error('comments')
                    <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit" style="background-color: #28a745; color: white; padding: 14px 28px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; font-weight: bold; width: 100%;">Create Post</button>

            <a href="{{ route('posts.index') }}" style="display: block; text-align: center; margin-top: 15px; color: #007bff; text-decoration: none;">Cancel</a>

        </form>
    </div>

    <!-- JAVASCRIPT FOR DYNAMIC COMMENTS -->
    <script>
        let commentCount = 0;

        function addCommentField() {
            commentCount++;
            const commentHTML = `
                <div style="padding: 15px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 10px; position: relative;" id="comment-${commentCount}">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <strong style="font-size: 14px; color: #333;">Comment #${commentCount}</strong>
                        <button type="button" onclick="removeCommentField(${commentCount})" style="background-color: #dc3545; color: white; border: none; padding: 4px 10px; border-radius: 3px; cursor: pointer; font-size: 12px;">Remove</button>
                    </div>
                    <input type="hidden" name="comments[${commentCount}][user_id]" value="1">
                    <textarea name="comments[${commentCount}][comment_text]" rows="3" placeholder="Write your comment here..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; box-sizing: border-box; resize: vertical;"></textarea>
                </div>
            `;
            document.getElementById('comments-container').insertAdjacentHTML('beforeend', commentHTML);
        }

        function removeCommentField(id) {
            const element = document.getElementById('comment-' + id);
            if (element) {
                element.remove();
            }
        }
    </script>

</body>
</html>