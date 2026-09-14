<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tags</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 40px; background-color: #f4f4f9;">

    <div style="max-width: 900px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1 style="color: #333; margin: 0; font-size: 28px;">Manage Tags</h1>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('tags.create') }}" style="display: inline-block; background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">+ Create Tag</a>
                <a href="{{ route('posts.index') }}" style="display: inline-block; background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Back to Posts</a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #28a745;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tags Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #007bff; color: white;">
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">ID</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Tag Name</th>
                    <th style="padding: 15px; text-align: center; border-bottom: 2px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tags as $tag)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 15px;">{{ $tag->id }}</td>
                        <td style="padding: 15px; font-weight: bold;">
                            <!-- Tag name ko badge ki tarah dikhana -->
                            <span style="background-color: #17a2b8; color: white; padding: 5px 10px; border-radius: 3px; font-size: 14px;">
                                {{ $tag->name }}
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <!-- View Posts Button (Special Route) -->
                            <a href="{{ route('tags.posts', $tag->id) }}" style="display: inline-block; background-color: #17a2b8; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; margin-right: 5px; font-size: 13px;">View Posts</a>
                            
                            <!-- Edit Button -->
                            <a href="{{ route('tags.edit', $tag->id) }}" style="display: inline-block; background-color: #ffc107; color: #333; padding: 6px 12px; text-decoration: none; border-radius: 4px; margin-right: 5px; font-size: 13px;">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure? This will remove this tag from all posts.')" style="background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 13px;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding: 30px; text-align: center; color: #999;">
                            No tags found. <a href="{{ route('tags.create') }}" style="color: #007bff;">Create your first tag!</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</body>
</html>