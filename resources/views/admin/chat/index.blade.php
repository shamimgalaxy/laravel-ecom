@extends('admin.master')

@section('body')

<style>
.chat-container { display: flex; height: calc(100vh - 140px); border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: #fff; }
.chat-sidebar { width: 300px; border-right: 1px solid #e2e8f0; display: flex; flex-direction: column; }
.chat-sidebar-header { padding: 16px; background: #1a3c6e; color: white; font-weight: 600; font-size: 15px; }
.conversation-list { overflow-y: auto; flex: 1; }
.conversation-item { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; cursor: pointer; transition: background 0.15s; display: flex; align-items: center; gap: 10px; }
.conversation-item:hover, .conversation-item.active { background: #f0f6ff; }
.conv-avatar { width: 40px; height: 40px; border-radius: 50%; background: #1a3c6e; display: flex; align-items: center; justify-content: center; color: white; font-size: 13px; font-weight: 600; flex-shrink: 0; }
.conv-info { flex: 1; min-width: 0; }
.conv-name { font-size: 13px; font-weight: 600; color: #1e293b; }
.conv-preview { font-size: 12px; color: #94a3b8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.conv-meta { text-align: right; }
.conv-time { font-size: 11px; color: #94a3b8; }
.conv-badge { background: #ef4444; color: white; font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 10px; display: inline-block; margin-top: 3px; }
.chat-main { flex: 1; display: flex; flex-direction: column; }
.chat-main-header { padding: 14px 20px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; display: flex; align-items: center; gap: 10px; }
.chat-main-avatar { width: 36px; height: 36px; border-radius: 50%; background: #22c55e; display: flex; align-items: center; justify-content: center; color: white; font-size: 12px; font-weight: 600; }
.chat-main-name { font-weight: 600; font-size: 14px; color: #1e293b; }
.chat-main-status { font-size: 12px; color: #22c55e; }
.chat-messages { flex: 1; overflow-y: auto; padding: 16px; display: flex; flex-direction: column; gap: 12px; background: #f8fafc; }
.msg { display: flex; gap: 8px; align-items: flex-end; }
.msg.admin { flex-direction: row-reverse; }
.msg-avatar { width: 28px; height: 28px; border-radius: 50%; background: #1a3c6e; display: flex; align-items: center; justify-content: center; font-size: 10px; color: white; font-weight: 600; flex-shrink: 0; }
.msg.admin .msg-avatar { background: #22c55e; }
.msg-bubble { max-width: 60%; padding: 10px 14px; border-radius: 14px; font-size: 13px; line-height: 1.5; background: #fff; border: 1px solid #e2e8f0; color: #1e293b; }
.msg.admin .msg-bubble { background: #1a3c6e; color: white; border-color: #1a3c6e; }
.msg-time { font-size: 10px; color: #94a3b8; margin-top: 3px; }
.chat-footer { padding: 12px 16px; border-top: 1px solid #e2e8f0; background: #fff; display: flex; gap: 10px; align-items: center; }
.chat-input { flex: 1; border: 1px solid #cbd5e1; border-radius: 20px; padding: 10px 16px; font-size: 13px; outline: none; }
.chat-input:focus { border-color: #1a6fd4; }
.chat-send-btn { width: 38px; height: 38px; background: #1a3c6e; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.chat-send-btn:hover { background: #1a6fd4; }
.chat-send-btn svg { width: 16px; height: 16px; fill: white; }
.no-chat-selected { flex: 1; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 8px; color: #94a3b8; font-size: 14px; }
</style>

<h2 class="mb-4">Customer Chat</h2>

<div class="chat-container">

    <div class="chat-sidebar">
        <div class="chat-sidebar-header">Conversations ({{ count($conversations) }})</div>
        <div class="conversation-list" id="conversationList">
            @forelse($conversations as $conv)
            <div class="conversation-item"
                 data-customer-id="{{ $conv['customer_id'] }}"
                 onclick="loadConversation('{{ $conv['customer_id'] }}', this)">
                <div class="conv-avatar">{{ strtoupper(substr($conv['customer_id'], 0, 2)) }}</div>
                <div class="conv-info">
                    <div class="conv-name">Customer {{ substr($conv['customer_id'], -6) }}</div>
                    <div class="conv-preview">{{ Str::limit($conv['latest_message'], 30) }}</div>
                </div>
                <div class="conv-meta">
                    <div class="conv-time">{{ $conv['latest_time'] }}</div>
                    @if($conv['unread_count'] > 0)
                        <span class="conv-badge" id="badge-{{ $conv['customer_id'] }}">{{ $conv['unread_count'] }}</span>
                    @endif
                </div>
            </div>
            @empty
            <div style="padding: 40px; text-align: center; color: #94a3b8;">
                <p>No conversations yet</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="chat-main" id="chatMain">
        <div class="no-chat-selected">
            <svg viewBox="0 0 24 24" style="width:48px;height:48px;fill:#cbd5e1">
                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
            </svg>
            <p>Select a conversation to start chatting</p>
        </div>
    </div>

</div>

@push('scripts')
<script>
    var PUSHER_KEY     = '{{ config("broadcasting.connections.pusher.key") }}';
    var PUSHER_CLUSTER = '{{ config("broadcasting.connections.pusher.options.cluster") }}';
    var CSRF_TOKEN     = '{{ csrf_token() }}';

    var currentCustomerId = null;
    var pusher            = null;
    var chatChannel       = null;

    pusher = new Pusher(PUSHER_KEY, {
        cluster:  PUSHER_CLUSTER,
        forceTLS: true
    });

    pusher.connection.bind('connected', function() {
        console.log('Pusher connected.');
    });

    pusher.connection.bind('error', function(err) {
        console.error('Pusher error:', err);
    });

    chatChannel = pusher.subscribe('chat');

chatChannel.bind('message.sent', function(data) {
    console.log('Event received:', data);

    if (data.sender === 'customer') {
        if (data.customer_id === currentCustomerId) {
            // ✅ Append incoming customer message to open chat
            appendMessage(data.message, 'customer', data.created_at);
        } else {
            // ✅ Update badge + preview for other conversations
            updateBadge(data.customer_id);
            updateConversationPreview(data.customer_id, data.message);
        }

    } else if (data.sender === 'admin') {
        // ✅ Another admin tab sent a message — sync it here
        if (data.customer_id === currentCustomerId) {
            // Only append if NOT already shown (avoid duplicate from optimistic render)
            // We skip appending here since sendAdminMessage() already called appendMessage()
            // But update the preview for the sidebar
            updateConversationPreview(data.customer_id, data.message);
        }
    }
});

    function loadConversation(customerId, el) {
        currentCustomerId = customerId;

        document.querySelectorAll('.conversation-item').forEach(function(i) {
            i.classList.remove('active');
        });
        el.classList.add('active');

        var badge = document.getElementById('badge-' + customerId);
        if (badge) badge.remove();

        document.getElementById('chatMain').innerHTML =
            '<div class="chat-main-header">' +
                '<div class="chat-main-avatar">C</div>' +
                '<div>' +
                    '<div class="chat-main-name">Customer ' + customerId.slice(-6) + '</div>' +
                    '<div class="chat-main-status">Active</div>' +
                '</div>' +
            '</div>' +
            '<div class="chat-messages" id="chatMessages">' +
                '<div style="text-align:center;color:#94a3b8;font-size:12px;padding:20px;">Loading messages...</div>' +
            '</div>' +
            '<div class="chat-footer">' +
                '<input class="chat-input" id="adminChatInput" type="text" placeholder="Type a reply..." />' +
                '<button class="chat-send-btn" onclick="sendAdminMessage()">' +
                    '<svg viewBox="0 0 24 24"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>' +
                '</button>' +
            '</div>';

        document.getElementById('adminChatInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') sendAdminMessage();
        });

        fetch('/admin/chat/messages/' + customerId, {
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept':       'application/json'
            }
        })
        .then(function(r) {
            if (!r.ok) throw new Error('HTTP ' + r.status);
            return r.json();
        })
        .then(function(data) {
            var container = document.getElementById('chatMessages');
            container.innerHTML = '';
            if (!data.messages || data.messages.length === 0) {
                container.innerHTML = '<div style="text-align:center;color:#94a3b8;font-size:12px;">No messages yet</div>';
                return;
            }
            data.messages.forEach(function(m) {
                appendMessage(m.message, m.from_type, m.created_at);
            });
        })
        .catch(function(err) {
            console.error('Error loading messages:', err);
            var container = document.getElementById('chatMessages');
            if (container) {
                container.innerHTML = '<div style="text-align:center;color:#ef4444;font-size:12px;">Failed to load messages.</div>';
            }
        });
    }

  function sendAdminMessage() {
    var input = document.getElementById('adminChatInput');
    var text  = input.value.trim();
    if (!text || !currentCustomerId) return;

    input.value = '';
    appendMessage(text, 'admin', new Date().toISOString());
    updateConversationPreview(currentCustomerId, text); // ✅ add this line

    fetch('/admin/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'Accept':       'application/json'
        },
        body: JSON.stringify({
            message:     text,
            customer_id: currentCustomerId
        })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) { console.log('Reply sent:', data); })
    .catch(function(err) {
        console.error('Send error:', err);
        // ❌ Optionally remove the optimistically added message on failure
    });
}

    function appendMessage(text, fromType, isoTime) {
        var container = document.getElementById('chatMessages');
        if (!container) return;

        var isAdmin  = fromType === 'admin';
        var time     = isoTime ? timeAgo(isoTime) : 'Just now';
        var initials = isAdmin ? 'AD' : 'C';

        var div     = document.createElement('div');
        div.className = 'msg' + (isAdmin ? ' admin' : '');
        div.innerHTML =
            '<div class="msg-avatar">' + initials + '</div>' +
            '<div>' +
                '<div class="msg-bubble">' + escapeHtml(text) + '</div>' +
                '<div class="msg-time">' + time + '</div>' +
            '</div>';
        container.appendChild(div);
        container.scrollTop = container.scrollHeight;
    }

    function updateBadge(customerId) {
        var badge = document.getElementById('badge-' + customerId);
        if (badge) {
            badge.textContent = parseInt(badge.textContent) + 1;
        } else {
            var item = document.querySelector('[data-customer-id="' + customerId + '"] .conv-meta');
            if (item) {
                badge             = document.createElement('span');
                badge.className   = 'conv-badge';
                badge.id          = 'badge-' + customerId;
                badge.textContent = '1';
                item.appendChild(badge);
            }
        }
    }

    function updateConversationPreview(customerId, message) {
        var item = document.querySelector('[data-customer-id="' + customerId + '"] .conv-preview');
        if (item) item.textContent = message.substring(0, 30);
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

    function timeAgo(isoTime) {
        var diff = Math.floor((new Date() - new Date(isoTime)) / 1000);
        if (diff < 60)    return 'Just now';
        if (diff < 3600)  return Math.floor(diff / 60) + 'm ago';
        if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';
        return Math.floor(diff / 86400) + 'd ago';
    }
</script>
@endpush

@endsection