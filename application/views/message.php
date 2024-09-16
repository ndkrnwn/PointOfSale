<?php if ($message = $this->session->flashdata('success')) { ?>
    <div id="swalDefaultSuccess" data-flash="<?= $message; ?>"> </div>
<?php } else if ($message = $this->session->flashdata('error')) { ?>
    <div id="swalDefaultError" data-flash="<?= $message; ?>"> </div>
<?php } else if ($message = $this->session->flashdata('deleted')) { ?>
    <div id="swalDefaultDeleted" data-flash="<?= $message; ?>"> </div>
<?php } else if ($message = $this->session->flashdata('warning')) { ?>
    <div id="swalDefaultWarning" data-flash="<?= $message; ?>"> </div>
<?php } else if ($message = $this->session->flashdata('login')) { ?>
    <div id="swalLogin" data-flash="<?= $message; ?>"> </div>
<?php } else if ($message = $this->session->flashdata('login_failed')) { ?>
    <div id="swalFailed" data-flash="<?= $message; ?>"> </div>
<?php } else if ($message = $this->session->flashdata('relation')) { ?>
    <div id="swalRelation" data-flash="<?= $message; ?>"> </div>
<?php } ?>