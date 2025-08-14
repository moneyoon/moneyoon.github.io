// 页面加载时生成分享链接
window.addEventListener('load', () => {
    const shareLinkInput = document.getElementById('shareLink');
    if (shareLinkInput) {
        shareLinkInput.value = window.location.href;
    }
});

// 复制链接功能
document.getElementById('copyBtn')?.addEventListener('click', () => {
    const shareLink = document.getElementById('shareLink');
    if (shareLink) {
        navigator.clipboard.writeText(shareLink.value)
            .then(() => {
                alert('链接已复制到剪贴板！');
            })
            .catch(err => {
                alert('复制失败，请手动复制链接。');
            });
    }
});