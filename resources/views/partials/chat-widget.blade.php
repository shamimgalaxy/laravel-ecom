{{-- resources/views/partials/chat-widget.blade.php --}}

<style>
.chat-widget-wrapper {
    position: fixed; bottom: 24px; right: 24px;
    display: flex; flex-direction: column; align-items: flex-end;
    gap: 8px; z-index: 9999;
}
.chat-bubble-btn {
    width: 54px; height: 54px;
    background: #22c55e; border-radius: 50%;
    border: none; cursor: pointer; position: relative;
    display: flex; align-items: center; justify-content: center;
    transition: transform 0.2s;
}
.chat-bubble-btn:hover { transform: scale(1.08); }
.chat-bubble-btn svg { width: 26px; height: 26px; fill: white; }
.chat-badge {
    position: absolute; top: -4px; right: -4px;
    min-width: 18px; height: 18px; padding: 0 4px;
    background: #ef4444; border-radius: 999px;
    border: 2px solid white; display: none;
    align-items: center; justify-content: center;
    font-size: 10px; font-weight: 700; color: white; line-height: 1;
}
#chat-box {
    width: 320px; border-radius: 16px; overflow: hidden;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    display: none; flex-direction: column; background: #fff;
}
#chat-box.open { display: flex; }
.chat-header {
    background: #1a3c6e; padding: 14px 16px;
    display: flex; align-items: center; gap: 10px; flex-shrink: 0;
}
.chat-header-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: #22c55e; display: flex;
    align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600; color: white;
}
.chat-header-name { color: white; font-size: 14px; font-weight: 600; }
.chat-header-status { color: #86efac; font-size: 11px; display: flex; align-items: center; gap: 4px; }
.chat-status-dot { width: 6px; height: 6px; background: #22c55e; border-radius: 50%; }
.chat-close-btn {
    margin-left: auto; background: none; border: none;
    color: rgba(255,255,255,0.7); font-size: 20px; cursor: pointer;
}
.chat-close-btn:hover { color: white; }
.chat-messages {
    height: 216px; overflow-y: auto; padding: 12px;
    display: flex; flex-direction: column; gap: 10px;
    background: #f8fafc; scroll-behavior: smooth; flex-shrink: 0;
}
.chat-messages::-webkit-scrollbar { width: 3px; }
.chat-messages::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
.msg { display: flex; gap: 8px; align-items: flex-end; }
.msg.user { flex-direction: row-reverse; }
.msg-avatar {
    width: 28px; height: 28px; border-radius: 50%;
    background: #1a3c6e; display: flex;
    align-items: center; justify-content: center;
    font-size: 10px; color: white; font-weight: 600; flex-shrink: 0;
}
.msg-bubble {
    max-width: 200px; padding: 8px 12px; border-radius: 14px;
    font-size: 13px; line-height: 1.5;
    background: #fff; border: 1px solid #e2e8f0; color: #1e293b;
}
.msg.user .msg-bubble { background: #1a3c6e; color: white; border-color: #1a3c6e; }
.msg-time { font-size: 10px; color: #94a3b8; margin-top: 2px; }
.msg.user .msg-time { text-align: right; }
.typing-dots { display: flex; align-items: center; gap: 3px; padding: 6px 4px; }
.typing-dots span {
    width: 6px; height: 6px; background: #94a3b8;
    border-radius: 50%; animation: bounce 1.2s infinite;
}
.typing-dots span:nth-child(2) { animation-delay: .2s; }
.typing-dots span:nth-child(3) { animation-delay: .4s; }
@keyframes bounce {
    0%,80%,100% { transform: translateY(0); }
    40%          { transform: translateY(-5px); }
}
.chat-scroll-row {
    display: none; justify-content: flex-end; gap: 6px;
    padding: 6px 10px; background: #fff;
    border-top: 1px solid #e2e8f0; flex-shrink: 0;
}
.chat-scroll-row.visible { display: flex; }
.chat-scroll-btn {
    width: 28px; height: 28px; border-radius: 50%;
    background: #1a3c6e; border: none; color: white;
    font-size: 13px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    opacity: 0.85; transition: opacity 0.15s;
}
.chat-scroll-btn:hover { opacity: 1; }
.chat-footer {
    padding: 10px 12px; background: #fff;
    border-top: 1px solid #e2e8f0;
    display: flex; gap: 8px; align-items: center; flex-shrink: 0;
}
.chat-input {
    flex: 1; border: 1px solid #cbd5e1; border-radius: 20px;
    padding: 8px 14px; font-size: 13px; outline: none;
    background: #f8fafc; color: #1e293b;
}
.chat-input:focus { border-color: #1a6fd4; }
.chat-send-btn {
    width: 34px; height: 34px; background: #1a6fd4;
    border: none; border-radius: 50%; cursor: pointer;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.chat-send-btn:hover { background: #1558b0; }
.chat-send-btn svg { width: 16px; height: 16px; fill: white; }
.chat-loading { text-align: center; color: #94a3b8; font-size: 12px; padding: 20px 0; }
</style>

{{-- ── Chat Widget ─────────────────────────────────────────── --}}
<div class="chat-widget-wrapper">

    <div id="chat-box">

        <div class="chat-header">
            <div class="chat-header-avatar">SG</div>
            <div>
                <div class="chat-header-name">{{ $adminUser->name ?? 'ShopGrids Support' }}</div>
                <div class="chat-header-status">
                    <span class="chat-status-dot"></span> Online
                </div>
            </div>
            <button class="chat-close-btn" onclick="toggleChat()" aria-label="Close chat">&#x2715;</button>
        </div>

        <div class="chat-messages" id="chatMessages"></div>

        <div class="chat-scroll-row" id="chatScrollRow">
            <button class="chat-scroll-btn" onclick="chatScrollUp()"   aria-label="Scroll up">&#9650;</button>
            <button class="chat-scroll-btn" onclick="chatScrollDown()" aria-label="Scroll down">&#9660;</button>
        </div>

        <div class="chat-footer">
            {{-- Fix 1: added name attribute → resolves "form field should have id or name" warning --}}
            <input
                class="chat-input"
                id="chatInput"
                name="chat_message"
                type="text"
                placeholder="Type a message..."
                autocomplete="off"
            />
            <button class="chat-send-btn" onclick="sendChatMessage()" aria-label="Send message">
                <svg viewBox="0 0 24 24"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
            </button>
        </div>

    </div>

    <button class="chat-bubble-btn" id="chatBubble" onclick="toggleChat()" aria-label="Open chat">
        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg>
        <span class="chat-badge" id="chatBadge"></span>
    </button>

</div>

<script>
    const ADMIN_ID       = parseInt('{{ $adminUser->id ?? 0 }}');
    const PUSHER_KEY     = '{{ config("broadcasting.connections.pusher.key") }}';
    const PUSHER_CLUSTER = '{{ config("broadcasting.connections.pusher.options.cluster") }}';
    const CSRF_TOKEN     = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let   CUSTOMER_ID    = '{{ Session::get("customer_id") ?? "" }}';

    // ── Pusher init ───────────────────────────────────────────
const pusher = new Pusher(PUSHER_KEY, {
    cluster:  PUSHER_CLUSTER,
    forceTLS: true,
    authorizer: (channel) => {
        return {
            authorize: (socketId, callback) => {
                fetch('/broadcasting/auth', {
                    method:      'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept':       'application/json',
                    },
                    body: new URLSearchParams({
                        socket_id:    socketId,
                        channel_name: channel.name,
                    }),
                })
                .then(res => res.json())
                .then(data => callback(null, data))
                .catch(err => callback(err, null));
            }
        };
    }
});

    pusher.connection.bind('error', (err) => console.error('Pusher error:', err));

    pusher.connection.bind('connected', function () {
        console.log('Pusher connected');
        loadPreviousMessages();
        if (CUSTOMER_ID) subscribeToCustomerChannel(CUSTOMER_ID);
    });

    // ── Channel tracker (keyed by customerId) ─────────────────
    const subscribedChannels = {};

    function subscribeToCustomerChannel(customerId) {
        if (!customerId || subscribedChannels[customerId]) return;

        const ch = pusher.subscribe('private-customer-' + customerId);  // ← CHANGED: added private-

        ch.bind('pusher:subscription_succeeded', () => {
            console.log('Subscribed to private-customer-' + customerId);
        });

        ch.bind('pusher:subscription_error', (err) => {          // ← ADDED: catch auth failures
            console.error('Subscription auth failed:', err);
        });

        const handleAdminMessage = function (data) {
            console.log('Admin reply received:', data);
            if (data.sender === 'admin') {
                removeTyping();
                addMessage(escapeHtml(data.message), false, data.created_at);
                incrementBadge();
            }
        };

        ch.bind('.message.sent', handleAdminMessage);
        ch.bind('message.sent',  handleAdminMessage);

        subscribedChannels[customerId] = ch;
    }

    // ── Load previous messages ────────────────────────────────
    function loadPreviousMessages() {
        const container = document.getElementById('chatMessages');

        if (!CUSTOMER_ID) {
            showWelcomeMessage();
            return;
        }

        container.innerHTML = '<div class="chat-loading">Loading messages...</div>';

        fetch('{{ route("chat.fetch") }}?receiver_id=' + ADMIN_ID, {
            headers: {
                'Accept':       'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN
            }
        })
        .then(res => {
            const contentType = res.headers.get('content-type') || '';
            if (!res.ok || !contentType.includes('application/json')) {
                throw new Error('Expected JSON, got: ' + contentType);
            }
            return res.json();
        })
        .then(data => {
            container.innerHTML = '';
            if (!data.messages || data.messages.length === 0) {
                showWelcomeMessage();
                return;
            }
            data.messages.forEach(msg => {
                addMessage(escapeHtml(msg.message), msg.from_type === 'customer', msg.created_at);
            });
        })
        .catch(err => {
            console.warn('Chat fetch warning:', err.message);
            container.innerHTML = '';
            showWelcomeMessage();
        });
    }

  function showWelcomeMessage() {
    const container = document.getElementById('chatMessages');
    if (!container) return;

    if (CUSTOMER_ID) {
        // Logged-in welcome
        const div = document.createElement('div');
        div.className = 'msg';
        div.innerHTML =
            '<div class="msg-avatar">SG</div>' +
            '<div>' +
                '<div class="msg-bubble">Hello! Welcome to ShopGrids. How can I help you today?</div>' +
                '<div class="msg-time">Just now</div>' +
            '</div>';
        container.appendChild(div);
    } else {
        // Guest — show two messages
        const msg1 = document.createElement('div');
        msg1.className = 'msg';
        msg1.innerHTML =
            '<div class="msg-avatar">SG</div>' +
            '<div>' +
                '<div class="msg-bubble">👋 Hello! Welcome to ShopGrids Support.</div>' +
                '<div class="msg-time">Just now</div>' +
            '</div>';

        const msg2 = document.createElement('div');
        msg2.className = 'msg';
        msg2.innerHTML =
            '<div class="msg-avatar">SG</div>' +
            '<div>' +
                '<div class="msg-bubble">🔒 Please <a href="/customer-login" style="color:#1a6fd4;font-weight:600;text-decoration:underline;">login</a> to start chatting with us.</div>' +
                '<div class="msg-time">Just now</div>' +
            '</div>';

        container.appendChild(msg1);

        // Small delay so second message feels natural
        setTimeout(() => {
            container.appendChild(msg2);
            container.scrollTop = container.scrollHeight;
        }, 600);
    }
}

    // ── Unread badge counter ──────────────────────────────────
    let unreadCount = 0;

    function incrementBadge() {
        const box = document.getElementById('chat-box');
        if (box && box.classList.contains('open')) return;
        unreadCount++;
        const badge = document.getElementById('chatBadge');
        if (!badge) return;
        badge.textContent   = unreadCount > 99 ? '99+' : unreadCount;
        badge.style.display = 'flex';
    }

    function resetBadge() {
        unreadCount = 0;
        const badge = document.getElementById('chatBadge');
        if (!badge) return;
        badge.textContent   = '';
        badge.style.display = 'none';
    }

    // ── Toggle open / close ───────────────────────────────────
  function toggleChat() {
    const box       = document.getElementById('chat-box');
    const scrollRow = document.getElementById('chatScrollRow');

    box.classList.toggle('open');
    resetBadge();

    if (box.classList.contains('open')) {
        if (scrollRow) scrollRow.classList.add('visible');

        // ✅ Show login prompt immediately if guest
        if (!CUSTOMER_ID) {
            const container = document.getElementById('chatMessages');
            if (container && container.children.length === 0) {
                showWelcomeMessage();
            }
        }

        const msgs = document.getElementById('chatMessages');
        if (msgs) msgs.scrollTop = msgs.scrollHeight;
        setTimeout(() => {
            const input = document.getElementById('chatInput');
            if (input) input.focus();
        }, 200);
    } else {
        if (scrollRow) scrollRow.classList.remove('visible');
    }
}

    function chatScrollUp()   { document.getElementById('chatMessages').scrollBy({ top: -72, behavior: 'smooth' }); }
    function chatScrollDown() { document.getElementById('chatMessages').scrollBy({ top:  72, behavior: 'smooth' }); }

    // ── Customer sends a message ──────────────────────────────
    function sendChatMessage() {
        const input = document.getElementById('chatInput');
        if (!input) return;
        const text = input.value.trim();
        if (!text) return;

        addMessage(escapeHtml(text), true);
        input.value = '';
        showTyping();

        fetch('{{ route("chat.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept':       'application/json'
            },
            body: JSON.stringify({ message: text, receiver_id: ADMIN_ID })
        })
        .then(response => {
            const contentType = response.headers.get('content-type') || '';
            if (!response.ok || !contentType.includes('application/json')) {
                return response.text().then(body => { throw new Error(body); });
            }
            return response.json();
        })
        .then(data => {
            removeTyping();
            const cid = data.customer_id || CUSTOMER_ID;
            if (cid) {
                CUSTOMER_ID = cid;
                subscribeToCustomerChannel(cid);
            }
        })
        .catch(err => {
            removeTyping();
            console.error('Chat send error:', err.message);
            addMessage('Sorry, something went wrong. Please try again.', false);
        });
    }

    // ── Helpers ───────────────────────────────────────────────
    function addMessage(text, isUser, isoTime) {
        const container = document.getElementById('chatMessages');
        if (!container) return;

        const time = isoTime ? timeAgo(isoTime) : 'Just now';
        const div  = document.createElement('div');
        div.className = 'msg' + (isUser ? ' user' : '');
        div.innerHTML =
            (!isUser ? '<div class="msg-avatar">SG</div>' : '') +
            '<div>' +
                '<div class="msg-bubble">' + text + '</div>' +
                '<div class="msg-time">' + time + '</div>' +
            '</div>';
        container.appendChild(div);
        container.scrollTop = container.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

    function timeAgo(isoTime) {
        const diff = Math.floor((new Date() - new Date(isoTime)) / 1000);
        if (diff < 60)    return 'Just now';
        if (diff < 3600)  return Math.floor(diff / 60)  + 'm ago';
        if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';
        return Math.floor(diff / 86400) + 'd ago';
    }

    function showTyping() {
        const container = document.getElementById('chatMessages');
        if (!container || document.getElementById('typingIndicator')) return;
        const div = document.createElement('div');
        div.className = 'msg';
        div.id = 'typingIndicator';
        div.innerHTML =
            '<div class="msg-avatar">SG</div>' +
            '<div class="msg-bubble">' +
                '<div class="typing-dots"><span></span><span></span><span></span></div>' +
            '</div>';
        container.appendChild(div);
        container.scrollTop = container.scrollHeight;
    }

    function removeTyping() {
        const t = document.getElementById('typingIndicator');
        if (t) t.remove();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const chatInput = document.getElementById('chatInput');
        if (chatInput) {
            chatInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') sendChatMessage();
            });
        }
    });
</script>