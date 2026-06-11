php

@extends('layouts-side-bar.master')
@section('content')

<style>
    /* ═══════════════════════════════════════════
                       FONTS & BASE
    ═══════════════════════════════════════════ */
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --forest:          #0d4b1f;
        --forest-mid:      #1a6b30;
        --green:           #287C44;
        --green-light:     #3da05a;
        --mint:            #e8f5e9;
        --mint-deep:       #c8e6c9;
        --amber:           #f59e0b;
        --amber-light:     #fef3c7;
        --sky:             #0ea5e9;
        --sky-light:       #e0f2fe;
        --coral:           #f43f5e;
        --coral-light:     #ffe4e6;
        --slate:           #64748b;
        --card-shadow:     0 4px 24px rgba(13,75,31,0.10);
        --card-shadow-hover: 0 12px 40px rgba(13,75,31,0.18);
        --radius:          16px;
        --radius-sm:       10px;
    }

    body, .side-app { font-family: 'DM Sans', sans-serif; background: #f0f4f1; }

    /* ─── HERO ──────────────────────────────── */
    .sreg-hero {
        background: linear-gradient(135deg, #0d4b1f 0%, #1a6b30 45%, #287C44 100%);
        border-radius: 20px;
        padding: 36px 40px 32px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }
    .sreg-hero::before {
        content:''; position:absolute; top:-60px; right:-60px;
        width:260px; height:260px;
        background:rgba(255,255,255,0.05); border-radius:50%;
    }
    .sreg-hero::after {
        content:''; position:absolute; bottom:-80px; left:30%;
        width:320px; height:320px;
        background:rgba(255,255,255,0.04); border-radius:50%;
    }
    .sreg-hero h1 {
        font-family:'Syne',sans-serif; font-size:28px; font-weight:800;
        color:#fff; margin:0 0 6px; letter-spacing:-0.5px;
        position:relative; z-index:1;
    }
    .sreg-hero p {
        color:rgba(255,255,255,0.75); margin:0; font-size:14px;
        position:relative; z-index:1;
    }
    .sreg-hero .hero-chip {
        background:rgba(255,255,255,0.15); backdrop-filter:blur(8px);
        border:1px solid rgba(255,255,255,0.25); color:#fff;
        padding:8px 18px; border-radius:50px; font-size:13px;
        font-weight:600; position:relative; z-index:1; white-space:nowrap;
    }

    /* ─── STAT GRID ─────────────────────────── */
    .stat-grid {
        display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:28px;
    }
    @media(max-width:992px){ .stat-grid{ grid-template-columns:repeat(2,1fr); } }
    @media(max-width:576px){ .stat-grid{ grid-template-columns:1fr 1fr; gap:10px; } }

    .stat-card {
        background:#fff; border-radius:var(--radius); padding:22px 20px 18px;
        box-shadow:var(--card-shadow); transition:all .3s ease;
        border:1.5px solid transparent; position:relative; overflow:hidden;
    }
    .stat-card:hover { transform:translateY(-3px); box-shadow:var(--card-shadow-hover); }
    .stat-card::after {
        content:''; position:absolute; bottom:0; left:0; right:0;
        height:3px; border-radius:0 0 var(--radius) var(--radius);
    }
    .stat-card.green::after  { background:var(--green); }
    .stat-card.sky::after    { background:var(--sky); }
    .stat-card.amber::after  { background:var(--amber); }
    .stat-card.coral::after  { background:var(--coral); }

    .stat-icon {
        width:44px; height:44px; border-radius:12px;
        display:flex; align-items:center; justify-content:center;
        font-size:18px; margin-bottom:14px;
    }
    .stat-card.green .stat-icon  { background:var(--mint);         color:var(--forest); }
    .stat-card.sky .stat-icon    { background:var(--sky-light);     color:#0369a1; }
    .stat-card.amber .stat-icon  { background:var(--amber-light);   color:#b45309; }
    .stat-card.coral .stat-icon  { background:var(--coral-light);   color:#be123c; }

    .stat-number {
        font-family:'Syne',sans-serif; font-size:34px; font-weight:800; line-height:1; margin-bottom:4px;
    }
    .stat-card.green .stat-number  { color:var(--forest); }
    .stat-card.sky .stat-number    { color:#0369a1; }
    .stat-card.amber .stat-number  { color:#b45309; }
    .stat-card.coral .stat-number  { color:#be123c; }
    .stat-label { font-size:12px; color:var(--slate); font-weight:500; letter-spacing:.3px; }

    /* ─── MAIN CARD ─────────────────────────── */
    .reg-card { background:#fff; border-radius:var(--radius); box-shadow:var(--card-shadow); overflow:hidden; margin-bottom:24px; }
    .reg-card-header {
        background:linear-gradient(135deg,var(--forest) 0%,var(--green) 100%);
        padding:20px 28px; display:flex; align-items:center; justify-content:space-between;
    }
    .reg-card-header h4 {
        font-family:'Syne',sans-serif; font-size:17px; font-weight:700; color:#fff; margin:0;
    }
    .reg-card-header .header-badge {
        background:rgba(255,255,255,0.18); color:#fff;
        border:1px solid rgba(255,255,255,0.3);
        padding:5px 14px; border-radius:20px; font-size:12px; font-weight:600;
    }
    .reg-card-body { padding:28px; }

    /* ─── SECTION LABELS ────────────────────── */
    .form-section-label {
        font-family:'Syne',sans-serif; font-size:12px; font-weight:700;
        color:var(--green); letter-spacing:1.2px; text-transform:uppercase;
        padding-bottom:10px; border-bottom:2px solid var(--mint-deep);
        margin-bottom:20px; margin-top:6px;
        display:flex; align-items:center; gap:8px;
    }

    /* ─── FORM CONTROLS ─────────────────────── */
    .reg-label { font-size:12px; font-weight:600; color:#374151; margin-bottom:6px; letter-spacing:.2px; }
    .reg-label .req { color:var(--coral); margin-left:2px; }

    .reg-input, .reg-select {
        border:1.5px solid #e5e7eb; border-radius:var(--radius-sm);
        padding:10px 14px; font-size:14px; color:#111;
        transition:all .2s; width:100%; background:#fafafa;
        font-family:'DM Sans',sans-serif;
    }
    .reg-input:focus, .reg-select:focus {
        border-color:var(--green); box-shadow:0 0 0 3px rgba(40,124,68,.12);
        background:#fff; outline:none;
    }
    .reg-input[readonly] {
        background:var(--mint); color:var(--forest);
        font-weight:600; border-color:var(--mint-deep);
    }

    /* ─── SCHOOL-NUMBER DISPLAY ─────────────── */
    .school-number-display {
        background:linear-gradient(135deg,var(--mint) 0%,#d1fae5 100%);
        border:2px dashed var(--green); border-radius:var(--radius-sm);
        padding:14px 18px; display:flex; align-items:center; gap:12px;
    }
    .school-number-display .num-icon {
        width:36px; height:36px; background:var(--green);
        border-radius:8px; display:flex; align-items:center;
        justify-content:center; color:#fff; font-size:15px; flex-shrink:0;
    }
    .school-number-display input {
        border:none; background:transparent;
        font-family:'Syne',sans-serif; font-size:16px;
        font-weight:700; color:var(--forest); width:100%;
    }
    .school-number-display input:focus { outline:none; }

    /* ─── BUTTONS ───────────────────────────── */
    .btn-primary-reg {
        background:linear-gradient(135deg,var(--green) 0%,var(--forest-mid) 100%);
        color:#fff; border:none; padding:12px 28px; border-radius:var(--radius-sm);
        font-family:'DM Sans',sans-serif; font-size:14px; font-weight:600;
        cursor:pointer; transition:all .3s;
        display:inline-flex; align-items:center; gap:8px;
    }
    .btn-primary-reg:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(40,124,68,.35); color:#fff; }

    .btn-secondary-reg {
        background:#fff; color:var(--slate); border:1.5px solid #e5e7eb;
        padding:11px 24px; border-radius:var(--radius-sm);
        font-family:'DM Sans',sans-serif; font-size:14px; font-weight:500;
        cursor:pointer; transition:all .3s;
        display:inline-flex; align-items:center; gap:8px;
    }
    .btn-secondary-reg:hover { background:#f8f9fa; border-color:#d1d5db; }

    /* ─── STATUS BADGES ─────────────────────── */
    .sbadge {
        display:inline-flex; align-items:center; gap:5px;
        padding:4px 12px; border-radius:20px; font-size:11px;
        font-weight:600; white-space:nowrap;
    }
    .sbadge-green  { background:var(--mint);       color:var(--forest); border:1px solid var(--mint-deep); }
    .sbadge-sky    { background:var(--sky-light);  color:#075985;       border:1px solid #bae6fd; }
    .sbadge-amber  { background:var(--amber-light);color:#92400e;       border:1px solid #fde68a; }
    .sbadge-coral  { background:var(--coral-light);color:#9f1239;       border:1px solid #fecdd3; }

    /* ─── TABLE ─────────────────────────────── */
    .reg-table-wrap { border-radius:var(--radius-sm); overflow:hidden; border:1.5px solid #e9ecef; }
    .reg-table { width:100%; border-collapse:collapse; margin:0; }
    .reg-table thead th {
        background:var(--forest); color:#fff; padding:13px 16px;
        font-family:'Syne',sans-serif; font-size:12px; font-weight:700;
        letter-spacing:.5px; text-transform:uppercase; border:none;
    }
    .reg-table tbody td {
        padding:12px 16px; border-bottom:1px solid #f1f5f9;
        font-size:13px; vertical-align:middle;
    }
    .reg-table tbody tr:last-child td { border-bottom:none; }
    .reg-table tbody tr:hover { background:#f8fffe; }

    /* DataTable overrides */
    .dataTables_wrapper { font-family:'DM Sans',sans-serif; }
    .dataTables_length label, .dataTables_filter label { font-size:13px; color:var(--slate); font-weight:500; }
    .dataTables_length select, .dataTables_filter input {
        border:1.5px solid #e5e7eb !important; border-radius:8px !important;
        padding:5px 10px !important; font-size:13px !important;
    }
    .dataTables_filter input:focus {
        border-color:var(--green) !important;
        box-shadow:0 0 0 3px rgba(40,124,68,.1) !important; outline:none !important;
    }
    .dataTables_paginate .paginate_button {
        border-radius:8px !important; border:1.5px solid #e5e7eb !important;
        color:var(--slate) !important; font-size:13px !important;
        padding:5px 11px !important; margin:0 2px !important; transition:all .2s !important;
    }
    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .paginate_button:hover {
        background:var(--green) !important; border-color:var(--green) !important; color:#fff !important;
    }
    .dataTables_info { font-size:12px; color:var(--slate); }

    /* ─── STEP WIZARD ───────────────────────── */
    .step-nav {
        display:flex; background:#fff; border-radius:var(--radius);
        box-shadow:var(--card-shadow); margin-bottom:28px; overflow:hidden;
    }
    .step-tab {
        flex:1; padding:18px 20px; display:flex; align-items:center;
        gap:12px; cursor:pointer; border:none; background:transparent;
        transition:all .3s; border-bottom:3px solid transparent; position:relative;
    }
    .step-tab:not(:last-child)::after {
        content:''; position:absolute; right:0; top:20%; bottom:20%;
        width:1px; background:#e9ecef;
    }
    .step-tab.active { background:var(--mint); border-bottom-color:var(--green); }
    .step-tab:hover:not(.active) { background:#f8f9fa; }
    .step-num {
        width:32px; height:32px; border-radius:50%;
        display:flex; align-items:center; justify-content:center;
        font-family:'Syne',sans-serif; font-weight:700; font-size:13px;
        flex-shrink:0; transition:all .3s;
    }
    .step-tab.active .step-num         { background:var(--green); color:#fff; }
    .step-tab:not(.active) .step-num   { background:#e9ecef; color:var(--slate); }
    .step-info { text-align:left; }
    .step-title { font-family:'Syne',sans-serif; font-weight:700; font-size:13px; color:var(--forest); margin:0; line-height:1.2; }
    .step-sub   { font-size:11px; color:var(--slate); margin:0; }
    .step-tab:not(.active) .step-title { color:var(--slate); }

    .step-panel { display:none; animation:fadeSlide .35s ease; }
    .step-panel.active { display:block; }
    @keyframes fadeSlide { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }

    /* ─── SWAL FIX ──────────────────────────── */
    .swal2-container { z-index:9999 !important; }
    .swal2-popup     { z-index:10000 !important; }
    .modal           { z-index:1050; }
    .modal-backdrop  { z-index:1040; }

    /* ─── RESPONSIVE ────────────────────────── */
    @media(max-width:768px){
        .sreg-hero { padding:24px 20px 20px; }
        .sreg-hero h1 { font-size:20px; }
        .reg-card-body { padding:20px 16px; }
        .step-tab .step-info { display:none; }
        .step-tab { justify-content:center; }
    }
</style>

<div class="side-app" style="padding:20px;">

    {{-- ══════════════ HERO ══════════════ --}}
    <div class="sreg-hero d-flex justify-content-between align-items-center flex-wrap" style="gap:16px;">
        <div>
            <h1><i class="fas fa-school" style="opacity:.85;margin-right:10px;"></i>School Registration Portal</h1>
            <p>Register new schools, manage records, and keep your institution directory up to date.</p>
        </div>
        <div class="hero-chip">
            <i class="fas fa-map-marker-alt mr-2"></i>Institution Management
        </div>
    </div>

    {{-- ══════════════ STAT CARDS ══════════════ --}}
    <div class="stat-grid">
        <div class="stat-card green">
            <div class="stat-icon"><i class="fas fa-school"></i></div>
            <div class="stat-number" id="stat-total">—</div>
            <div class="stat-label">Total Schools Registered</div>
        </div>
        <div class="stat-card sky">
            <div class="stat-icon"><i class="fas fa-user-tie"></i></div>
            <div class="stat-number" id="stat-with-head">—</div>
            <div class="stat-label">With Head of School Assigned</div>
        </div>
        <div class="stat-card amber">
            <div class="stat-icon"><i class="fas fa-map-pin"></i></div>
            <div class="stat-number" id="stat-locations">—</div>
            <div class="stat-label">Distinct Locations</div>
        </div>
        <div class="stat-card coral">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-number" id="stat-recent">—</div>
            <div class="stat-label">Registered This Month</div>
        </div>
    </div>

    {{-- ══════════════ STEP WIZARD ══════════════ --}}
    <div class="step-nav">
        <button class="step-tab active" onclick="switchStep(1,this)">
            <div class="step-num">1</div>
            <div class="step-info">
                <p class="step-title">Register School</p>
                <p class="step-sub">Fill in school details</p>
            </div>
        </button>
        <button class="step-tab" onclick="switchStep(2,this)">
            <div class="step-num">2</div>
            <div class="step-info">
                <p class="step-title">All Schools</p>
                <p class="step-sub">View & manage records</p>
            </div>
        </button>
    </div>

    {{-- ══════════════════════════════════════════════════════
    STEP 1 — REGISTER SCHOOL
    ══════════════════════════════════════════════════════ --}}
    <div class="step-panel active" id="panel-1">
        <div class="reg-card">
            <div class="reg-card-header">
                <h4><i class="fas fa-plus-circle mr-2"></i>New School Registration</h4>
                <span class="header-badge"><i class="fas fa-info-circle mr-1"></i>Step 1 of 2</span>
            </div>
            <div class="reg-card-body">

                <form id="schoolRegForm">
                    @csrf

                    {{-- Identity --}}
                    <div class="form-section-label"><i class="fas fa-id-badge"></i> School Identity</div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="reg-label">School Name (English) <span class="req">*</span></label>
                            <input type="text" name="house_name" id="house_name" class="reg-input"
                                   placeholder="e.g. Al-Noor Islamic School" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="reg-label">
                                School Number <span class="req">*</span>
                                <span style="font-weight:400;color:var(--slate);">(Unique 6-char identifier)</span>
                            </label>
                            <div class="school-number-display">
                                <div class="num-icon"><i class="fas fa-hashtag"></i></div>
                                <input type="text" name="number" id="school_number"
                                       maxlength="6" placeholder="e.g. SCH001"
                                       oninput="this.value=this.value.toUpperCase()" required>
                            </div>
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="form-section-label mt-2"><i class="fas fa-map-marker-alt"></i> Location</div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="reg-label">Location / Address <span class="req">*</span></label>
                            <input type="text" name="location" class="reg-input"
                                   placeholder="e.g. Kampala, Uganda" required>
                        </div>
                    </div>

                    {{-- Administration --}}
                    <div class="form-section-label mt-2"><i class="fas fa-users-cog"></i> Administration</div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="reg-label">Head of School</label>
                            <select name="head" id="school_head" class="reg-select select2">
                                <option value="0">-- No Head Assigned --</option>
                                @foreach ($staff ?? [] as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                            <small style="color:var(--slate);font-size:11px;margin-top:4px;display:block;">
                                <i class="fas fa-info-circle"></i> Can be assigned later if staff not yet registered.
                            </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="reg-label">Contact Person</label>
                            <select name="contact_person" id="school_contact" class="reg-select select2">
                                <option value="0">-- No Contact Assigned --</option>
                                @foreach ($staff ?? [] as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Registration Date (auto) --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="reg-label">Registration Date</label>
                            <input type="text" class="reg-input" value="{{ now()->format('d / m / Y  —  H:i') }}" readonly
                                   title="Automatically recorded on submission">
                        </div>
                    </div>

                    <hr style="border-color:#f1f5f9;margin:24px 0;">

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn-secondary-reg" onclick="window.history.back()">
                            <i class="fas fa-arrow-left"></i> Back
                        </button>
                        <button type="submit" class="btn-primary-reg">
                            <i class="fas fa-paper-plane"></i> Register School
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════
    STEP 2 — ALL SCHOOLS
    ══════════════════════════════════════════════════════ --}}
    <div class="step-panel" id="panel-2">
        <div class="reg-card">
            <div class="reg-card-header">
                <h4><i class="fas fa-list-alt mr-2"></i>All Registered Schools</h4>
                <span class="header-badge"><i class="fas fa-database mr-1"></i>Step 2 of 2</span>
            </div>
            <div class="reg-card-body">
                <div class="reg-table-wrap" style="overflow:auto;">
                    <table class="reg-table table table-bordered" id="schoolsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>School Number</th>
                                <th>School Name</th>
                                <th>Location</th>
                                <th>Head</th>
                                <th>Contact Person</th>
                                <th>Registered On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="schoolsTableBody">
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="fas fa-spinner fa-spin mr-2"></i> Loading schools…
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>{{-- /side-app --}}


{{-- ══════════════════════════════════════════════════════
EDIT SCHOOL MODAL
══════════════════════════════════════════════════════ --}}
<div class="modal fade" id="editSchoolModal" tabindex="-1" role="dialog" aria-labelledby="editSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius:16px;overflow:hidden;border:none;">
            <div class="modal-header"
                 style="background:linear-gradient(135deg,#0d4b1f,#287C44);color:white;border:none;padding:20px 28px;">
                <h5 class="modal-title" id="editSchoolModalLabel"
                    style="font-family:'Syne',sans-serif;font-weight:700;margin:0;">
                    <i class="fas fa-edit mr-2"></i> Edit School Record
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" style="opacity:1;">
                    <span aria-hidden="true" style="font-size:22px;">&times;</span>
                </button>
            </div>
            <form id="editSchoolForm">
                <div class="modal-body" style="padding:24px 28px;">
                    <input type="hidden" name="edit_id" id="edit_id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="reg-label">School Name <span class="req">*</span></label>
                            <input type="text" name="edit_house_name" id="edit_house_name" class="reg-input" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="reg-label">School Number <span class="req">*</span></label>
                            <div class="school-number-display">
                                <div class="num-icon"><i class="fas fa-hashtag"></i></div>
                                <input type="text" name="edit_number" id="edit_number"
                                       maxlength="6" oninput="this.value=this.value.toUpperCase()" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="reg-label">Location <span class="req">*</span></label>
                            <input type="text" name="edit_location" id="edit_location" class="reg-input" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="reg-label">Head of School</label>
                            <select name="edit_head" id="edit_head" class="reg-select">
                                <option value="0">-- None --</option>
                                @foreach ($staff ?? [] as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="reg-label">Contact Person</label>
                            <select name="edit_contact_person" id="edit_contact_person" class="reg-select">
                                <option value="0">-- None --</option>
                                @foreach ($staff ?? [] as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #f1f5f9;padding:16px 28px;">
                    <button type="button" class="btn-secondary-reg" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn-primary-reg">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    // ── Select2 ──────────────────────────────────
    if ($.fn.select2) {
        $('.select2').select2({ theme: 'bootstrap4', width: '100%' });
    }

    // ── Step switching ────────────────────────────
    window.switchStep = function (num, el) {
        document.querySelectorAll('.step-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('panel-' + num).classList.add('active');
        if (num === 2 && !$.fn.DataTable.isDataTable('#schoolsTable')) {
            loadSchools();
        }
    };

    // ── Analytics ────────────────────────────────
    function loadAnalytics() {
        $.ajax({
            url: '{{ route("school.houses.list") }}',
            method: 'GET',
            success: function (response) {
                const schools = response.schools || [];
                const total   = schools.length;
                const withHead = schools.filter(s => s.Head && s.Head != 0).length;

                const locations = new Set(
                    schools.map(s => (s.Location || '').trim().toLowerCase()).filter(Boolean)
                ).size;

                const thisMonth = (() => {
                    const now  = new Date();
                    const y    = now.getFullYear();
                    const m    = now.getMonth();
                    return schools.filter(s => {
                        if (!s.RegistrationDate) return false;
                        const d = new Date(s.RegistrationDate);
                        return d.getFullYear() === y && d.getMonth() === m;
                    }).length;
                })();

                animateNum('stat-total',     total);
                animateNum('stat-with-head', withHead);
                animateNum('stat-locations', locations);
                animateNum('stat-recent',    thisMonth);
            }
        });
    }

    function animateNum(id, target) {
        const el   = document.getElementById(id);
        if (!el) return;
        let current = 0;
        const step  = Math.ceil(target / 20) || 1;
        const timer = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = current;
            if (current >= target) clearInterval(timer);
        }, 40);
    }

    loadAnalytics();

    // ── Load Schools Table ────────────────────────
    function loadSchools() {
        $.ajax({
            url: '{{ route("school.houses.list") }}',
            method: 'GET',
            success: function (response) {
                const schools = response.schools || [];
                let html = '';

                if (schools.length === 0) {
                    html = `<tr><td colspan="8" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-2x d-block mb-2" style="color:#d1d5db;"></i>
                                No schools registered yet.
                            </td></tr>`;
                } else {
                    schools.forEach((s, i) => {
                        const headName    = s.head_name    || '<span class="text-muted" style="font-size:12px;">Not assigned</span>';
                        const contactName = s.contact_name || '<span class="text-muted" style="font-size:12px;">Not assigned</span>';
                        const regDate     = s.RegistrationDate
                            ? new Date(s.RegistrationDate).toLocaleDateString('en-GB', { day:'2-digit', month:'short', year:'numeric' })
                            : '—';

                        html += `<tr>
                            <td>${i + 1}</td>
                            <td><code style="font-size:12px;color:var(--forest);background:var(--mint);padding:3px 7px;border-radius:6px;">${s.Number}</code></td>
                            <td><span style="font-weight:600;font-size:13px;">${s.House}</span></td>
                            <td><i class="fas fa-map-marker-alt mr-1" style="color:var(--coral);font-size:11px;"></i>${s.Location}</td>
                            <td>${headName}</td>
                            <td>${contactName}</td>
                            <td><span style="font-size:12px;color:var(--slate);">${regDate}</span></td>
                            <td>
                                <div style="display:flex;gap:6px;flex-wrap:nowrap;align-items:center;">
                                    <button class="btn btn-sm btn-primary edit-school"
                                            data-id="${s.ID}"
                                            style="border-radius:7px;white-space:nowrap;">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-school"
                                            data-id="${s.ID}" data-name="${s.House}"
                                            style="border-radius:7px;white-space:nowrap;">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>`;
                    });
                }

                $('#schoolsTableBody').html(html);

                if ($.fn.DataTable.isDataTable('#schoolsTable')) {
                    $('#schoolsTable').DataTable().clear().destroy();
                }

                $('#schoolsTable').DataTable({
                    pageLength: 10,
                    lengthMenu: [[5,10,25,50,-1],[5,10,25,50,'All']],
                    searching: true, ordering: true, order: [[0,'asc']],
                    language: {
                        search: 'Search:', searchPlaceholder: 'Type to search…',
                        emptyTable: 'No schools found',
                        info: 'Showing _START_–_END_ of _TOTAL_ schools',
                        infoEmpty: '0 schools',
                        lengthMenu: 'Show _MENU_',
                        paginate: { first:'«', last:'»', previous:'‹', next:'›' }
                    },
                    dom: '<"row mb-2"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-12"tr>><"row mt-2"<"col-sm-5"i><"col-sm-7"p>>'
                });

                loadAnalytics();
            },
            error: function () {
                $('#schoolsTableBody').html(
                    '<tr><td colspan="8" class="text-center text-danger py-4">Error loading schools.</td></tr>'
                );
            }
        });
    }

    // Also load on first render (for analytics denominator)
    loadSchools();

    // ── Register School ───────────────────────────
    $('#schoolRegForm').on('submit', function (e) {
        e.preventDefault();
        const $f = $(this);

        const required = ['house_name','number','location'];
        let valid = true;
        required.forEach(n => {
            const inp = $f.find(`[name="${n}"]`);
            if (!inp.val().trim()) { inp.addClass('is-invalid'); valid = false; }
            else inp.removeClass('is-invalid');
        });

        if (!valid) {
            Swal.fire({ icon:'error', title:'Missing Fields', text:'Please fill in all required fields.', confirmButtonColor:'#287C44' });
            return;
        }

        Swal.fire({
            title: 'Register School?',
            text:  'Confirm new school registration.',
            icon:  'question',
            showCancelButton: true,
            confirmButtonColor: '#287C44', cancelButtonColor: '#dc2626',
            confirmButtonText: 'Yes, register!'
        }).then(result => {
            if (!result.isConfirmed) return;
            Swal.fire({ title:'Saving…', allowOutsideClick:false, didOpen:()=>Swal.showLoading() });

            $.ajax({
                url:     '{{ route("school.houses.store") }}',
                method:  'POST',
                data: {
                    house_name:     $f.find('[name="house_name"]').val().trim(),
                    number:         $f.find('[name="number"]').val().trim(),
                    location:       $f.find('[name="location"]').val().trim(),
                    head:           $f.find('[name="head"]').val(),
                    contact_person: $f.find('[name="contact_person"]').val(),
                },
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: r => Swal.fire({ icon:'success', title:'Registered!', text: r.message, confirmButtonColor:'#287C44' })
                    .then(() => location.reload()),
                error: xhr => Swal.fire({
                    icon:'error', title:'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong.',
                    confirmButtonColor:'#dc2626'
                })
            });
        });
    });

    // ── Delete School ─────────────────────────────
    $(document).on('click', '.delete-school', function () {
        const id   = $(this).data('id');
        const name = $(this).data('name');

        Swal.fire({
            title: 'Delete School?',
            html:  `Are you sure you want to remove <b>${name}</b>?`,
            icon:  'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626', cancelButtonColor: '#287C44',
            confirmButtonText: 'Yes, delete!'
        }).then(result => {
            if (!result.isConfirmed) return;
            Swal.fire({ title:'Deleting…', allowOutsideClick:false, didOpen:()=>Swal.showLoading() });
            $.ajax({
                url:    '{{ route("school.houses.delete") }}',
                method: 'POST',
                data:   { id, _token:'{{ csrf_token() }}' },
                success: r => Swal.fire({ icon:'success', title:'Deleted!', text: r.message, confirmButtonColor:'#287C44' })
                    .then(() => location.reload()),
                error: xhr => Swal.fire({
                    icon:'error', title:'Error',
                    text: xhr.responseJSON?.message || 'Failed to delete.',
                    confirmButtonColor:'#dc2626'
                })
            });
        });
    });

    // ── Open Edit Modal ───────────────────────────
    $(document).on('click', '.edit-school', function () {
        const id = $(this).data('id');

        $.ajax({
            url:    '{{ route("school.houses.get") }}',
            method: 'GET',
            data:   { id },
            success: function (r) {
                const s = r.school;
                $('#edit_id').val(s.ID);
                $('#edit_house_name').val(s.House);
                $('#edit_number').val(s.Number);
                $('#edit_location').val(s.Location);
                $('#edit_head').val(s.Head || 0);
                $('#edit_contact_person').val(s.ContactPerson || 0);
                $('#editSchoolModal').modal('show');
            },
            error: () => Swal.fire({ icon:'error', title:'Error', text:'Failed to load school data.', confirmButtonColor:'#dc2626' })
        });
    });

    // ── Update School ─────────────────────────────
    $('#editSchoolForm').on('submit', function (e) {
        e.preventDefault();

        const data = {
            id:             $('#edit_id').val(),
            house_name:     $('#edit_house_name').val().trim(),
            number:         $('#edit_number').val().trim(),
            location:       $('#edit_location').val().trim(),
            head:           $('#edit_head').val(),
            contact_person: $('#edit_contact_person').val(),
        };

        if (!data.house_name || !data.number || !data.location) {
            Swal.fire({ icon:'error', title:'Missing Fields', text:'Name, Number and Location are required.', confirmButtonColor:'#287C44' });
            return;
        }

        Swal.fire({
            title: 'Save Changes?',
            icon:  'question',
            showCancelButton: true,
            confirmButtonColor: '#287C44', cancelButtonColor: '#dc2626',
            confirmButtonText: 'Yes, save!'
        }).then(result => {
            if (!result.isConfirmed) return;
            Swal.fire({ title:'Saving…', allowOutsideClick:false, didOpen:()=>Swal.showLoading() });

            $.ajax({
                url:     '{{ route("school.houses.update") }}',
                method:  'POST',
                data:    { ...data, _token:'{{ csrf_token() }}' },
                success: r => Swal.fire({ icon:'success', title:'Updated!', text: r.message, confirmButtonColor:'#287C44' })
                    .then(res => { if (res.isConfirmed) { $('#editSchoolModal').modal('hide'); location.reload(); } }),
                error: xhr => Swal.fire({
                    icon:'error', title:'Error',
                    text: xhr.responseJSON?.message || 'Failed to update.',
                    confirmButtonColor:'#dc2626'
                })
            });
        });
    });

});
</script>
@endsection
@endsection