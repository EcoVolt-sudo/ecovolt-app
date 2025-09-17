function drawConsumptionChart(data) {
    const canvas = document.getElementById('consumptionChart');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const width = canvas.width;
    const height = canvas.height;
    
    ctx.clearRect(0, 0, width, height);
    
    const maxValue = Math.max(...data.map(item => item[1]));
    const minValue = Math.min(...data.map(item => item[1]));
    const range = maxValue - minValue;
    
    const padding = 40;
    const chartWidth = width - padding * 2;
    const chartHeight = height - padding * 2;
    
    ctx.strokeStyle = '#667eea';
    ctx.lineWidth = 3;
    ctx.beginPath();
    
    data.forEach((item, index) => {
        const x = padding + (index / (data.length - 1)) * chartWidth;
        const y = padding + chartHeight - ((item[1] - minValue) / range) * chartHeight;
        
        if (index === 0) {
            ctx.moveTo(x, y);
        } else {
            ctx.lineTo(x, y);
        }
        
        ctx.fillStyle = '#667eea';
        ctx.beginPath();
        ctx.arc(x, y, 4, 0, 2 * Math.PI);
        ctx.fill();
    });
    
    ctx.stroke();
    
    ctx.fillStyle = '#666';
    ctx.font = '12px Arial';
    data.forEach((item, index) => {
        const x = padding + (index / (data.length - 1)) * chartWidth;
        ctx.fillText(item[0].substring(0, 3), x - 15, height - 10);
    });
}

function animatePoints(element, targetPoints) {
    const startPoints = 0;
    const duration = 1000;
    const startTime = performance.now();
    
    function animate(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        const currentPoints = Math.floor(startPoints + (targetPoints - startPoints) * progress);
        element.textContent = currentPoints;
        
        if (progress < 1) {
            requestAnimationFrame(animate);
        }
    }
    
    requestAnimationFrame(animate);
}

function showBadgeAnimation(badgeName) {
    const notification = document.createElement('div');
    notification.className = 'badge-popup';
    notification.innerHTML = `
        <div class="badge-popup-content">
            <div class="badge-icon">🏆</div>
            <h3>Nova Badge!</h3>
            <p>${badgeName}</p>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function() {
    const pointsElements = document.querySelectorAll('.stat-card h3');
    pointsElements.forEach(element => {
        const points = parseInt(element.textContent);
        if (!isNaN(points)) {
            animatePoints(element, points);
        }
    });
    
    const taskButtons = document.querySelectorAll('.btn-complete');
    taskButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
    
    const badges = document.querySelectorAll('.badge.earned');
    badges.forEach((badge, index) => {
        badge.style.animationDelay = `${index * 0.1}s`;
        badge.style.animation = 'slideIn 0.5s ease forwards';
    });
});