<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/user/chatbot/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>eBook Marketing Mastery</title>
</head>

<body>
    <nav id="sidebar">
        <div class="float-top">
            <div class="sidebar-controls">
                <button class="new-chat"><i class="fa fa-plus"></i> New chat</button>
                <button class="hide-sidebar"><i class="fa fa-chevron-left"></i></button>
            </div>
            <ul class="conversations">
                <li class="grouping">Today</li>
                <li class="active">
                    <button class="conversation-button"><i class="fa fa-message fa-regular"></i> This is a conversation
                        title</button>
                    <div class="fade"></div>
                    <div class="edit-buttons">
                        <button><i class="fa fa-edit"></i></button>
                        <button><i class="fa fa-trash"></i></button>
                    </div>
                </li>
                <li class="grouping">Yesterday</li>
                <li>
                    <button class="conversation-button"><i class="fa fa-message fa-regular"></i> This is a very super
                        long conversation title that doesn't fit</button>
                    <div class="fade"></div>
                    <div class="edit-buttons">
                        <button><i class="fa fa-edit"></i></button>
                        <button><i class="fa fa-trash"></i></button>
                    </div>
                </li>
                <li class="grouping">Previous 7 days</li>
                <li>
                    <button class="conversation-button"><i class="fa fa-message fa-regular"></i> This is a conversation
                        title</button>
                    <div class="fade"></div>
                    <div class="edit-buttons">
                        <button><i class="fa fa-edit"></i></button>
                        <button><i class="fa fa-trash"></i></button>
                    </div>
                </li>
            </ul>
        </div>
        <div class="user-menu">
            <button>
                <i class="user-icon">u</i>
                username
                <i class="fa fa-ellipsis dots"></i>
            </button>
            <ul>
                <li><button>Log out</button></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="view new-chat-view">
            <div class="model-selector">
                {{-- <button class="gpt-3 selected">
                    <i class="fa fa-bolt"></i> GPT-3.5
                    <div class="model-info">
                        <div class="model-info-box">
                            <p>Our fastest model, great for most every day tasks.</p>
                            <p class="secondary">Available to Free and Plus users</p>
                        </div>
                    </div>
                </button> --}}
                <button class="gpt-3 selected">
                    <a href="{{ url('/') }}" style="color: white;text-decoration:none"><i class="fa fa-bolt"></i> Go Back</a>
                </button>
            </div>
            <div class="logo">
            Ask anything from your Tutor
            </div>
        </div>

        <div class="view conversation-view">
            {{-- <div class="model-name">
                <i class="fa fa-bolt"></i> Default (GPT-3.5)
            </div> --}}
            <div class="user message">
                <div class="identity">
                    <i class="user-icon">u</i>
                </div>
                <div class="content">
                    <p>Hello, how are you?</p>
                </div>
            </div>
            <div class="assistant message">
                <div class="identity">
                    <i class="gpt user-icon">G</i>
                </div>
                <div class="content">
                    <p>I'm doing well, thank you!</p>
                </div>
            </div>
        </div>
        <div id="message-form">
            <div class="message-wrapper">
                <textarea id="message" rows="1" placeholder="Send a message"></textarea>
                <button class="send-button"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </main>
    <script src="{{ asset('/user/chatbot/script.js') }}"></script>
</body>

</html>
