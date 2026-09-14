<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
</head>
<body style="
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 40px;
    background-color: #f4f4f9;
">

    <!-- Container: Saara content is box mein hoga -->
    <div style="
        /* CSS: Container ko center karta hai aur max-width limit karta hai */
        max-width: 1200px;           /* Maximum choraai 1200px, uske baad center mein rahega */
        margin: 0 auto;              /* Left-right auto margin se center align hota hai */
        background-color: white;     /* White background */
        padding: 30px;               /* Andar se 30px spacing */
        border-radius: 8px;          /* Corners ko 8px tak round/gol karta hai */
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);  /* Halka sa shadow (parchhai) */
    ">
        
        <!-- Header: Title aur Create Button -->
        <div style="
          
            display: flex;           /* Flexbox enable karta hai (items side by side) */
            justify-content: space-between;  /* Dono items ke beech maximum space */
            align-items: center;     /* Vertically center align karta hai */
            margin-bottom: 30px;     /* Neeche 30px ki spacing */
        ">
            <h1 style="
                /* CSS: Title ki styling */
                color: #333;         /* Dark gray color */
                margin: 0;           /* Default margin hata deta hai */
                font-size: 32px;     /* Font size 32px */
            ">All Posts</h1>
            
            <!-- Navigation Links -->
            <div style="display: flex; gap: 10px;">
                <!-- Create New Post Button -->
                <!-- route('posts.create') se URL generate hota hai -->
                <a href="{{ route('posts.create') }}" style="
                    /* CSS: Link ko button jaisa look deta hai */
                    display: inline-block;       /* Inline element ko block banata hai taake padding kaam kare */
                    background-color: #007bff;   /* Blue color (Bootstrap primary) */
                    color: white;                /* Text white */
                    padding: 12px 24px;          /* Top-bottom 12px, left-right 24px spacing */
                    text-decoration: none;       /* Underline hata deta hai */
                    border-radius: 5px;          /* Corners ko 5px round karta hai */
                    font-weight: bold;           /* Text ko mota (bold) karta hai */
                ">+ Create Post</a>
                
                <!-- Tags Link -->
                <a href="{{ route('tags.index') }}" style="
                    display: inline-block;
                    background-color: #6c757d;   /* Gray color */
                    color: white;
                    padding: 12px 24px;
                    text-decoration: none;
                    border-radius: 5px;
                    font-weight: bold;
                ">Manage Tags</a>
            </div>
        </div>

        <!-- Success Message -->
        <!-- session('success') controller se aata hai jab redirect hota hai with('success', 'message') -->
        @if(session('success'))
            <div style="
                /* CSS: Success message box ki styling */
                background-color: #d4edda;   /* Light green background */
                color: #155724;              /* Dark green text */
                padding: 15px;               /* Andar se 15px spacing */
                border-radius: 5px;          /* Rounded corners */
                margin-bottom: 20px;         /* Neeche 20px spacing */
                border-left: 4px solid #28a745;  /* Left side green border (accent) */
            ">
                {{ session('success') }}
            </div>
        @endif

        <!-- Posts Table -->
        <table style="
            /* CSS: Table ki styling */
            width: 100%;               /* Poori width le leta hai */
            border-collapse: collapse; /* Borders ko merge karke single line banata hai */
            margin-top: 20px;          /* Upar 20px spacing */
        ">
            <!-- Table Header -->
            <thead>
                <tr style="
                    /* CSS: Header row ki styling */
                    background-color: #082c54;  /* Blue background */
                    color: white;               /* White text */
                ">
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">ID</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Title</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Author</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Description</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Tags</th>
                    <th style="padding: 15px; text-align: center; border-bottom: 2px solid #ddd;">Comments</th>
                    <th style="padding: 15px; text-align: center; border-bottom: 2px solid #ddd;">Actions</th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody>
                <!-- 
                    Controller se $posts variable aaya hai jo Collection hai
                    Har post mein relationships loaded hain:
                    - $post->user (Post ka author)
                    - $post->comments (Post ke comments)
                    - $post->tags (Post ke tags)
                -->
                @foreach($posts as $post)
                    <tr style="
                        /* CSS: Har row ki styling */
                        border-bottom: 1px solid #ddd;  /* Neeche light gray border */
                    ">
                        <!-- ID Column -->
                        <td style="padding: 15px;">{{ $post->id }}</td>
                        
                        <!-- Title Column -->
                        <td style="padding: 15px; font-weight: bold;">{{ $post->title }}</td>
                        
                        <!-- Author Column (from user relationship) -->
                        <td style="padding: 15px;">{{ $post->user->name ?? 'Unknown' }}</td>
                        
                        <!-- Description Column -->
                        <td style="padding: 15px; color: #666;">
                            <!-- Str::limit() se description ko 50 characters tak limit karte hain -->
                            {{ Str::limit($post->description, 50) }}
                        </td>
                        
                        <!-- Tags Column (from tags relationship - Many-to-Many) -->
                        <td style="padding: 15px;">
                            @if($post->tags->isNotEmpty())
                                <!-- Har tag ko badge ki tarah dikhana -->
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('tags.posts', $tag->id) }}" style="
                                        display: inline-block;
                                        background-color: #17a2b8;  /* Teal color */
                                        color: white;
                                        padding: 4px 8px;
                                        border-radius: 3px;
                                        font-size: 12px;
                                        text-decoration: none;
                                        margin-right: 5px;
                                        margin-bottom: 5px;
                                    ">{{ $tag->name }}</a>
                                @endforeach
                            @else
                                <span style="color: #999; font-size: 14px;">No tags</span>
                            @endif
                        </td>
                        
                        <!-- Comments Column (from comments relationship) -->
                        <td style="padding: 15px; text-align: center;">
                            <!-- Comments count dikhana -->
                            <a href="{{ route('comments.index', $post->id) }}" style="
                                color: #1f5084;
                                text-decoration: none;
                                font-weight: bold;
                            ">
                                {{ $post->comments->count() }} comments
                            </a>
                        </td>
                        
                        <!-- Actions Column -->
                        <td style="padding: 15px; text-align: center;">
                            <!-- Edit Button -->
                            <!-- route('posts.edit', $post->id) se edit URL generate hota hai -->
                            <a href="{{ route('posts.edit', $post->id) }}" style="
                                /* CSS: Edit button ki styling */
                                display: inline-block;
                                background-color: #ffc107;   /* Yellow/amber color */
                                color: #333;                 /* Dark text */
                                padding: 8px 16px;           /* Spacing */
                                text-decoration: none;       /* No underline */
                                border-radius: 4px;          /* Rounded corners */
                                margin-right: 10px;          /* Right side 10px spacing */
                                font-size: 14px;             /* Font size */
                            ">Edit</a>

                            <!-- Delete Form -->
                            <!-- DELETE method ke liye form zaroori hai -->
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="
                                    /* CSS: Delete button ki styling */
                                    background-color: #dc3545;   /* Red color */
                                    color: white;                /* White text */
                                    padding: 8px 16px;           /* Spacing */
                                    border: none;                /* Border hata deta hai */
                                    border-radius: 4px;          /* Rounded corners */
                                    cursor: pointer;             /* Mouse par hand icon */
                                    font-size: 14px;             /* Font size */
                                " onclick="return confirm('Are you sure? This will delete the post and all its comments.')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Agar koi post nahi hai -->
        @if($posts->isEmpty())
            <div style="
                /* CSS: Empty state message ki styling */
                text-align: center;      /* Center align */
                padding: 40px;           /* Andar se 40px spacing */
                color: #999;             /* Light gray text */
            ">
                <p style="font-size: 18px;">No posts found.</p>
                <p>Create your first post by clicking the button above!</p>
            </div>
        @endif

    </div>

</body>
</html>