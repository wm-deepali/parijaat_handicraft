<style>
    :root {
        --bg: #f1f2f4;
        --surface: #ffffff;
        --border: #e3e5e8;
        --text-primary: #202223;
        --text-secondary: #6d7175;
        --text-hint: #8c9196;
        --accent: #303d89;
        --accent-light: #f0f1fc;
        --green: #007a5e;
        --green-bg: #e3f1ec;
        --amber: #8a5a00;
        --amber-bg: #fff4dc;
        --red: #b22222;
        --red-bg: #fce8e8;
        --radius-sm: 8px;
        --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    /* ══════════════ LIST PAGES (index screens) ══════════════ */
    .list-page {
        background: var(--bg);
        padding: 24px 28px;
        min-height: 100vh;
        font-family: var(--font);
        color: var(--text-primary);
    }

    .list-page * {
        box-sizing: border-box;
    }

    .list-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .list-page-header h1 {
        font-size: 20px;
        font-weight: 650;
        color: var(--text-primary);
        margin: 0;
    }

    .list-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        overflow: hidden;
    }

    .list-card .table-responsive {
        overflow-x: auto;
        border: 0;
        margin: 0;
    }

    .alert-box {
        background: var(--green-bg);
        color: var(--green);
        border: 1px solid #b7dccf;
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        margin-bottom: 16px;
        font-size: 13px;
        font-weight: 500;
    }

    /* Table */
    .list-card .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        margin: 0;
    }

    .list-card .data-table thead th {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--text-hint);
        padding: 10px 16px;
        border-bottom: 1px solid var(--border);
        background: #fafafa;
        text-align: left;
        white-space: nowrap;
    }

    .list-card .data-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .1s;
    }

    .list-card .data-table tbody tr:last-child {
        border-bottom: none;
    }

    .list-card .data-table tbody tr:hover {
        background: #fafbfc;
    }

    .list-card .data-table tbody td {
        padding: 12px 16px;
        color: var(--text-primary);
        vertical-align: middle;
        border-bottom: none;
    }

    /* Slider image */
    .slider-img {
        width: 96px;
        height: 54px;
        object-fit: cover;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
        display: block;
    }

    .slider-img-placeholder {
        width: 96px;
        height: 54px;
        border-radius: var(--radius-sm);
        background: var(--bg);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-hint);
        font-size: 18px;
    }

    /* Content cell */
    .txt-eyebrow {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 3px;
    }

    .txt-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-primary);
        max-width: 340px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .txt-muted {
        font-size: 12px;
        color: var(--text-hint);
        font-style: italic;
    }

    /* Chips */
    .id-chip {
        display: inline-block;
        background: var(--bg);
        color: var(--text-secondary);
        font-size: 11px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 6px;
        font-family: 'SF Mono', 'Fira Code', monospace;
    }

    .btn-chip {
        display: inline-block;
        background: var(--accent-light);
        color: var(--accent);
        font-size: 11.5px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 6px;
        margin: 0 4px 4px 0;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }

    .btn-chip.warn {
        background: var(--amber-bg);
        color: var(--amber);
    }

    .theme-chip {
        display: inline-block;
        background: var(--bg);
        color: var(--text-secondary);
        font-size: 11.5px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 6px;
        text-transform: capitalize;
    }

    .sort-chip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 24px;
        padding: 0 8px;
        background: var(--surface);
        border: 1px solid var(--border);
        color: var(--text-primary);
        font-size: 12px;
        font-weight: 700;
        border-radius: 6px;
    }

    /* Status pills */
    .pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11.5px;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 20px;
    }

    .pill::before {
        content: '';
        width: 5px;
        height: 5px;
        border-radius: 50%;
        display: inline-block;
        background: currentColor;
    }

    .pill-active,
    .pill-on {
        background: var(--green-bg);
        color: var(--green);
    }

    .pill-inactive,
    .pill-off {
        background: var(--red-bg);
        color: var(--red);
    }

    /* Action buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
        background: var(--surface);
        color: var(--text-secondary);
        font-size: 12px;
        cursor: pointer;
        transition: all .12s;
        text-decoration: none;
        padding: 0;
    }

    .action-btn:hover {
        background: var(--bg);
        color: var(--text-primary);
        text-decoration: none;
    }

    .action-btn-danger:hover {
        background: var(--red-bg);
        border-color: #f5c6c6;
        color: var(--red);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 64px 20px;
    }

    .empty-state .empty-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--bg);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: var(--text-hint);
        margin-bottom: 14px;
    }

    .empty-state p {
        font-size: 14px;
        color: var(--text-secondary);
        margin: 6px 0 16px;
    }

    /* Pagination */
    .pagination-bar {
        padding: 14px 20px;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: center;
        background: var(--surface);
    }

    .pagination-bar .pagination {
        margin: 0;
    }

    /* ══════════════ DETAIL / FORM PAGES ══════════════ */
    .detail-page {
        background: var(--bg);
        padding: 24px 28px;
        min-height: 100vh;
        font-family: var(--font);
        color: var(--text-primary);
    }

    .detail-page * {
        box-sizing: border-box;
    }

    .detail-page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .detail-page-header h1 {
        font-size: 20px;
        font-weight: 650;
        margin: 0;
    }

    .crumb {
        font-size: 12.5px;
        color: var(--text-hint);
        margin-top: 3px;
    }

    .crumb a {
        color: var(--accent);
        text-decoration: none;
    }

    .crumb a:hover {
        text-decoration: underline;
    }

    .crumb span {
        margin: 0 5px;
    }

    .create-layout {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 20px;
        align-items: start;
    }

    @media(max-width:900px) {
        .create-layout {
            grid-template-columns: 1fr;
        }
    }

    .section-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        overflow: hidden;
        margin-bottom: 16px;
    }

    .section-card:last-child {
        margin-bottom: 0;
    }

    .section-card-header {
        padding: 14px 20px;
        border-bottom: 1px solid var(--border);
        background: #fafafa;
    }

    .section-card-header h5 {
        font-size: 13px;
        font-weight: 650;
        margin: 0;
    }

    .section-card-body {
        padding: 20px;
    }

    .field-group {
        margin-bottom: 16px;
    }

    .field-group:last-child {
        margin-bottom: 0;
    }

    .field-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-secondary);
        letter-spacing: .03em;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .field-label .req {
        color: var(--red);
        margin-left: 2px;
    }

    .field-hint {
        font-size: 11.5px;
        color: var(--text-hint);
        margin-top: 4px;
        line-height: 1.6;
    }

    .field-input,
    .field-textarea {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 0 12px;
        height: 38px;
        font-size: 13.5px;
        color: var(--text-primary);
        background: var(--surface);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        font-family: var(--font);
    }

    .field-textarea {
        height: auto;
        padding: 10px 12px;
        resize: vertical;
        min-height: 70px;
    }

    .field-input:focus,
    .field-textarea:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
    }

    .two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    @media(max-width:600px) {
        .two-col {
            grid-template-columns: 1fr;
        }
    }

    .upload-zone {
        border: 2px dashed var(--border);
        border-radius: var(--radius-md);
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color .15s, background .15s;
        position: relative;
    }

    .upload-zone:hover {
        border-color: var(--accent);
        background: var(--accent-light);
    }

    .upload-zone input[type=file] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-zone .uz-icon {
        font-size: 28px;
        color: var(--text-hint);
        margin-bottom: 8px;
    }

    .upload-zone .uz-title {
        font-size: 13px;
        font-weight: 600;
    }

    .upload-zone .uz-sub {
        font-size: 11.5px;
        color: var(--text-hint);
        margin-top: 4px;
    }

    #imgPreview {
        display: none;
        margin-top: 12px;
    }

    #imgPreview img {
        width: 100%;
        max-height: 180px;
        object-fit: cover;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
    }

    #imgPreview button {
        font-size: 12px;
        color: var(--red);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        margin-top: 6px;
    }

    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid var(--bg);
    }

    .toggle-row:first-child {
        padding-top: 0;
    }

    .toggle-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .toggle-label {
        font-size: 13px;
        font-weight: 500;
    }

    .toggle-sub {
        font-size: 11.5px;
        color: var(--text-hint);
        margin-top: 1px;
    }

    .field-select-sm {
        height: 32px;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 0 28px 0 10px;
        font-size: 12.5px;
        color: var(--text-primary);
        background: var(--surface);
        outline: none;
        font-family: var(--font);
        min-width: 100px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 9px center;
    }

    .field-select-sm:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
    }

    .err-box {
        background: var(--red-bg);
        color: var(--red);
        border: 1px solid #f5c6c6;
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .err-box ul {
        margin: 0;
        padding-left: 18px;
    }

    .ok-box {
        background: #e3f1ec;
        color: #007a5e;
        border: 1px solid #b7dccf;
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    /* ══════════════ SHARED BUTTONS ══════════════ */
    .btn-primary-dash {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--accent);
        color: #fff !important;
        border: none;
        border-radius: var(--radius-sm);
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none !important;
        font-family: var(--font);
        transition: background .15s;
        box-shadow: 0 1px 3px rgba(48, 61, 137, .25);
    }

    .btn-primary-dash:hover {
        background: #252f70;
    }

    .btn-secondary-dash {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--surface);
        color: var(--text-primary) !important;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none !important;
        font-family: var(--font);
        transition: background .15s;
    }

    .btn-secondary-dash:hover {
        background: var(--bg);
    }

    .action-bar {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        padding: 14px 20px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    /* ══════════════ LEGACY HELPERS (other home pages) ══════════════ */
    .toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        padding: 14px 20px;
        border-bottom: 1px solid var(--border);
    }

    .thumb {
        width: 54px;
        height: 72px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid var(--border);
    }

    .row-actions {
        display: flex;
        gap: 6px;
    }

    .icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 6px;
        border: 1px solid var(--border);
        background: var(--surface);
        color: var(--text-primary) !important;
        cursor: pointer;
        text-decoration: none !important;
        font-size: 13px;
    }

    .icon-btn:hover {
        background: var(--bg);
    }

    .icon-btn.danger {
        color: var(--red) !important;
    }

    .stat-chip {
        font-size: 12.5px;
        color: var(--text-secondary);
    }

    .stat-chip b {
        color: var(--text-primary);
    }

    @media(max-width:768px) {
        .list-page,
        .detail-page {
            padding: 16px;
        }
    }
</style>