@extends('website.master')



@section('title', )
customer dashboard

@section('body')
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-6">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Dashboard</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li>Complete Order</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="checkout-wrapper section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                            <div class="list-group">
  
                            <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                            <a href="{{ route('customer.profile') }}" class="list-group-item list-group-item-action">Profile</a>
                            <a href="{{ route('customer.order') }}" class="list-group-item list-group-item-action">Order</a>
                            <a href="#" class="list-group-item list-group-item-action">Account</a>
                            <a href="#" class="list-group-item list-group-item-action">Change Password</a>
                            <a href="#" class="list-group-item list-group-item-action">Logout</a>
                             <a href="{{ route('customer.chat-support') }}" class="list-group-item list-group-item-action">Chat Support</a>
                            <a href="#" class="list-group-item list-group-item-action disabled" aria-disabled="true">A disabled link item</a>
                            </div>
             

            </div>

<div class="col-md-9">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0"><i class="lni lni-comments"></i> Chat with Admin</h5>
        </div>
        <div class="card-body p-0 d-flex flex-column" style="height: 50vh; background: #f9f9f9;">
            <div id="chatWindow" class="flex-grow-1 p-3" style="overflow-y:auto;">
                @if(isset($messages))
                    @foreach($messages as $msg)
                        <div class="mb-3 {{ $msg->from_id == Session::get('customer_id') ? 'text-end' : 'text-start' }}">
                            <div class="d-inline-block p-2 px-3 rounded shadow-sm {{ $msg->from_id == Session::get('customer_id') ? 'bg-primary text-white' : 'bg-white text-dark' }}" style="max-width: 80%;">
                                {{ $msg->message }}
                            </div>
                            <div class="small text-muted mt-1" style="font-size: 0.7rem;">
                                {{ $msg->created_at->format('h:i A') }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="border-top p-3 bg-white">
                <form id="chatForm" class="d-flex">
                    <input type="text" id="messageInput" class="form-control me-2" placeholder="Type a message..." autocomplete="off">
                    <button class="btn btn-primary" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>    
        </div>
    </div>
</section>
@endsection

@push('child-script')
    <script>
        $(document).ready(function() {
            // Adding quotes prevents syntax errors if the PHP variables are empty/null
            const authId = "{{ Session::get('customer_id') ?? '' }}";
            const userId = "{{ $user->id ?? '' }}";
            const chatWindow = $("#chatWindow");

            function messageBubble(m){
                const mine = m.from_id == authId;
                const align = mine ? 'text-start' : 'text-end';
                const bubble = mine ? 'text-light bg-dark' : 'bg-light';
                const name = mine ? 'You' : 'Admin';
                return `
                    <div class="${align} mb-2">
                        <div class="small text-muted">${name}</div>
                        <span class="d-inline-block px-3 py-2 rounded ${bubble}" style="max-width:75%;">${m.message}</span>
                    </div>
                `;
            }

                        function fetchMessages() {
                $.ajax({
                    url: "{{ route('customer.chat.fetch') }}", // You'll need to create this route
                    method: "GET",
                    data: { receiver_id: userId },
                    success: function(response) {
                        // Logic to check if there are new messages and append them
                        // Often, you'd empty the window and re-render or just append 'new' IDs
                        if (response.messages.length > currentCount) {
                            // Re-render chat logic here
                        }
                    }
                });
            }

// Check for new messages every 5 seconds
setInterval(fetchMessages, 5000);

            // Auto-scroll to bottom on load
            chatWindow.scrollTop(chatWindow[0].scrollHeight);

            $("#chatForm").on('submit', function(e) {
                e.preventDefault();

                let message = $('#messageInput').val();

                // Using an IF block instead of 'return' to avoid the Illegal Return error
                if (message.trim() !== '') {
                    $.ajax({
                        url: "{{ route('customer.chat.send') }}", 
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            receiver_id: userId,
                            message: message
                        },
                        success: function(response) {
                            // Clear input field
                            $('#messageInput').val('');

                            // Append the new message visually
                            let newMessage = `
                                <div class="mb-3 text-end">
                                    <div class="d-inline-block p-2 px-3 rounded shadow-sm bg-primary text-white" style="max-width: 80%;">
                                        ${message}
                                    </div>
                                    <div class="small text-muted mt-1" style="font-size: 0.7rem;">
                                        Just now
                                    </div>
                                </div>`;
                            
                            chatWindow.append(newMessage);
                            chatWindow.scrollTop(chatWindow[0].scrollHeight);
                        },
                        error: function(err) {
                            console.error("AJAX Error:", err);
                        }
                    });
                }
            });
        });
    </script>
@endpush

