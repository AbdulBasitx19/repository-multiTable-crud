<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Tagged "{{ $tag->name }}"</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 40px; background-color: #f4f4f9;">

    <div style="max-width: 900px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1 style="color: #333; margin: 0; font-size: 28px;">
                Posts tagged with 
                <span style="background-color: #17a2b8; color: white; padding: 5px 15px; border-radius: 5px; font-size: 24px;">
                    {{ $tag->name }}
                </span>
            </h1>
            <a href="{{ route('tags.index') }}" style="color: #007bff; text-decoration: none; font-weight: bold;">← Back to Tags</a>
        </div>

        <!-- Posts List -->
        @if($posts->isNotEmpty())
            @foreach($posts as $post)
                <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 20px; background-color: #fafafa;">
                    
                    <!-- Post Title -->
                    <h2 style="margin: 0 0 10px 0; color: #333; font-size: 22px;">
                        <a href="{{ route('posts.edit', $post->id) }}" style="color: #007bff; text-decoration: none;">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- Post Meta (Author & Date) -->
                    <div style="font-size: 14px; color: #666; margin-bottom: 15px;">
                        By <strong>{{ $post->user->name ?? 'Unknown' }}</strong> 
                        <span style="margin-left: 10px;">• {{ $post->created_at->format('M d, Y') }}</span>
                    </div>

                    <!-- Post Description -->
                    <p style="color: #555; line-height: 1.6; margin: 0 0 15px 0;">
                        {{ Str::limit($post->description, 150) }}
                    </p>

                    <!-- Post Footer (Comments Count & All Tags) -->
                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px;">
                        <!-- Comments Link -->
                        <a href="{{ route('comments.index', $post->id) }}" style="color: #007bff; text-decoration: none; font-size: 14px; font-weight: bold;">
                            💬 {{ $post->comments->count() }} Comments
                        </a>

                        <!-- All Tags for this post -->
                        <div>
                            @foreach($post->tags as $postTag)
                                <a href="{{ route('tags.posts', $postTag->id) }}" style="display: inline-block; background-color: #e9ecef; color: #495057; padding: 3px 8px; border-radius: 3px; font-size: 12px; text-decoration: none; margin-left: 5px;">
                                    {{ $postTag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <div style="text-align: center; padding: 40px; color: #999;">
                <p style="font-size: 18px;">No posts found with the tag "{{ $tag->name }}".</p>
                <a href="{{ route('posts.create') }}" style="color: #007bff; text-decoration: none;">Create a new post</a>
            </div>
        @endif

    </div>

</body>
</html>