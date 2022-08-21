<footer class="mt-auto text-dark pt-3 rounded px-2" style="background:linear-gradient(45deg, #F8F8FF, #E6E6FA);">
    <p>&nbsp; &copy:Laundry <?php echo date('Y') ?>.</p>
</footer>
</div>

<!-- Modal -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Yakin ingin logout ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="<?php echo base_url('logoutcust') ?>" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>
