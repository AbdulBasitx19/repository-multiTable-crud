<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tag</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 40px; background-color: #f4f4f9;">

    <div style="max-width: 500px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        
        <h1 style="color: #333; margin-bottom: 30px; font-size: 28px;">Create New Tag</h1>

        <form action="{{ route('tags.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Tag Name:</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g., Laravel, PHP, Web Dev" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px; box-sizing: border-box;" required>
                
                @error('name')
                    <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" style="background-color: #28a745; color: white; padding: 14px 28px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; font-weight: bold; width: 100%;">Create Tag</button>

            <a href="{{ route('tags.index') }}" style="display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none;">Cancel</a>

        </form>
    </div>

</body>
</html>