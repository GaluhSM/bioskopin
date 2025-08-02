<style>
.seat-btn:disabled {
    cursor: not-allowed !important;
}

.seat-btn:not(:disabled):hover {
    transform: scale(1.1);
}

@media (max-width: 640px) {
    .seat-btn {
        width: 1.5rem;
        height: 1.5rem;
        font-size: 0.625rem;
    }
}

.seat-btn {
    transition: all 0.2s ease;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.fa-spin {
    animation: spin 1s linear infinite;
}
</style>