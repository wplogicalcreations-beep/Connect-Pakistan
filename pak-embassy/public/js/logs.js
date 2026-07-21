document.addEventListener('DOMContentLoaded', function() {
    const logDot = document.getElementById('logDot');
    const logList = document.getElementById('logList');
    const noLogs = document.getElementById('noLogs');

    // Load logs on page load
    loadLogs();

    // Refresh logs every 30 seconds
    setInterval(function() {
        loadLogs();
    }, 30000);

    // Load logs
    function loadLogs() {
        const logsUrl = document.querySelector('meta[name="logs-url"]')?.getAttribute('content') || '/logs';
        fetch(logsUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            updateLogUI(data.logs);
        })
        .catch(error => {
            console.error('Error loading logs:', error);
        });
    }


    // Update log UI
    function updateLogUI(logs) {
        if (logs.length === 0) {
            logList.style.display = 'none';
            noLogs.style.display = 'block';
            // Hide red dot when no logs
            if (logDot) {
                logDot.style.display = 'none';
            }
        } else {
            logList.style.display = 'block';
            noLogs.style.display = 'none';
            // Show red dot when logs are available
            if (logDot) {
                logDot.style.display = 'block';
            }

            let html = '';
            logs.forEach(function(log) {
                html += `
                    <div class="itemflex" style="display: flex; padding: 10px 15px; border-bottom: 1px solid #eee; align-items: center; gap: 8px;">
                        <div class="leftItemsFle" style="flex: 1; min-width: 0; overflow: hidden;">
                            <div class="newsTxt d-flex justify-content-between align-items-center">
                                <div style="flex: 1; min-width: 0; overflow: hidden;">
                                    <label class="text-16 fw-bold text-overflow-70 pe-2" style="font-size: 14px; font-weight: bold; margin-bottom: 4px; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${escapeHtml(log.header || 'Log Entry')}</label>
                                    <p class="text-14 text-overflow-95" style="font-size: 12px; color: #666; margin: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; line-height: 1.4;">${escapeHtml(log.description || log.message || '')}</p>
                                </div>
                            </div>
                        </div>
                        <div class="rightItems" style="flex-shrink: 0; min-width: 70px;">
                            <p class="text-14 fw-500" style="font-size: 12px; font-weight: 500; margin: 0; white-space: nowrap; text-align: right;">${log.formatted_date || getFormattedDate(log.date)}</p>
                        </div>
                    </div>
                `;
            });
            logList.innerHTML = html;
        }
    }


    // Get level CSS class
    function getLevelClass(level) {
        const classes = {
            'error': 'bg-danger',
            'critical': 'bg-danger',
            'warning': 'bg-warning text-dark',
            'info': 'bg-info',
            'debug': 'bg-secondary',
            'alert': 'bg-warning text-dark',
            'emergency': 'bg-danger'
        };
        return classes[level] || 'bg-secondary';
    }

    // Get level icon
    function getLevelIcon(level) {
        const icons = {
            'error': 'fa-solid fa-circle-exclamation',
            'critical': 'fa-solid fa-triangle-exclamation',
            'warning': 'fa-solid fa-exclamation',
            'info': 'fa-solid fa-circle-info',
            'debug': 'fa-solid fa-bug',
            'alert': 'fa-solid fa-bell',
            'emergency': 'fa-solid fa-circle-exclamation'
        };
        return icons[level] || 'fa-solid fa-circle';
    }

    // Truncate message
    function truncateMessage(message, maxLength) {
        if (message.length <= maxLength) {
            return message;
        }
        return message.substring(0, maxLength) + '...';
    }

    // Get time ago
    function getTimeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffInSeconds = Math.floor((now - date) / 1000);

        if (diffInSeconds < 60) {
            return 'Just now';
        } else if (diffInSeconds < 3600) {
            const minutes = Math.floor(diffInSeconds / 60);
            return `${minutes}m ago`;
        } else {
            const hours = Math.floor(diffInSeconds / 3600);
            return `${hours}h ago`;
        }
    }

    // Escape HTML
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Get formatted date
    function getFormattedDate(dateString) {
        if (!dateString) return new Date().toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = date.toLocaleDateString('en-GB', { month: 'short' });
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }
});

