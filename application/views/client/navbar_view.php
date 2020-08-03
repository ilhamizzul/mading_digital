<a class="navbar-brand" href="<?= base_url() ?>Home">
    <img src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name') ?>/company/<?= $this->session->userdata('company_logo') ?>" alt="not found" class="d-inline-block align-top" alt="">
</a>
<ul class="nav justify-content-end">
    <li class="nav-item">
        <p class="navbar-link datetime"><span id="datetime"></span></p>
    </li>
</ul>