</div>

    <?php
        $message=get_message();
        if($message):
    ?>
            <div class="message-holder mx-3 my-3">
                    <div class="toast align-items-center text-bg-<?php echo $message['type']; ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                <?php echo $message['content']; ?>
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
            </div>

        <?php  clear_message(); ?>
    <?php endif; ?>
    <script src="<?php echo url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo url('assets/js/back.js'); ?>"></script>
</body>
</html>
