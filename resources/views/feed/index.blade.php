@extends('layouts.app')

@section('title', 'Discover')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --blue: #2563eb;
        --blue-d: #1d4ed8;
        --blue-soft: rgba(37, 99, 235, .07);
        --text: #1a1a2e;
        --text-mid: #374151;
        --text-muted: #6b7280;
        --border: rgba(0, 0, 0, .07);
        --bg: #f5f7fa;
        --surface: #fff;
        --radius: 14px;
        --shadow: 0 2px 10px rgba(0, 0, 0, .06);
        --shadow-h: 0 6px 20px rgba(0, 0, 0, .1);
        --primary-gradient: linear-gradient(135deg, #667eea, #764ba2);
        --cl-primary: #2563eb;
        --cl-primary-d: #1d4ed8;
        --cl-tag-bg: rgba(37, 99, 235, .07);
        --cl-tag-text: #2563eb;
        --cl-border: rgba(0, 0, 0, .07);
        --cl-text: #1a1a2e;
        --cl-text-sec: #6b7280;
        --cl-ans-bg: #f0fdf4;
        --cl-ans-bdr: #22c55e;
        --cl-accent: #e7440d;
        --cl-surface: #fff;
        --cl-bg: #f5f7fa;
    }

    * {
        font-family: 'DM Sans', sans-serif
    }

    .feed-container {
        background: var(--bg);
        min-height: 100vh
    }

    /* ── SIDEBAR ── */
    .profile-card,
    .news-card {
        border-radius: var(--radius);
        border: none;
        box-shadow: var(--shadow);
        background: var(--surface)
    }

    .profile-card:hover,
    .news-card:hover {
        box-shadow: var(--shadow-h)
    }

    .profile-avatar {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border: 3px solid var(--blue)
    }

    .sidebar-link {
        padding: .45rem .9rem;
        border-radius: 8px;
        transition: all .2s;
        font-weight: 500;
        font-size: 14px
    }

    .sidebar-link:hover {
        background: var(--blue-soft);
        color: var(--blue) !important;
        transform: translateX(4px)
    }

    .news-link {
        padding: .4rem 0;
        display: block;
        color: var(--text-mid);
        font-weight: 500;
        font-size: 13.5px;
        text-decoration: none;
        transition: all .2s
    }

    .news-link:hover {
        color: var(--blue);
        padding-left: .4rem
    }

    .sticky-sidebar {
        position: sticky;
        top: 80px;
        max-height: calc(100vh - 90px);
        overflow-y: auto;
        scrollbar-width: none;
        /* hides scrollbar on Firefox */
    }

    @media(max-width:768px) {
        .sticky-sidebar {
            position: relative;
            top: 0
        }
    }

    /* ── POST CARDS ── */
    .post-card {
        border-radius: var(--radius);
        border: none;
        box-shadow: var(--shadow);
        background: var(--surface);
        margin-bottom: 1rem;
        transition: box-shadow .25s
    }

    .post-card:hover {
        box-shadow: var(--shadow-h)
    }

    .post-header {
        padding: .9rem 1.1rem;
        border-bottom: 1px solid #f0f2f5
    }

    .post-media-wrapper {
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee
    }

    .action-btn {
        border: none;
        background: transparent;
        padding: .55rem .9rem;
        border-radius: 8px;
        transition: all .2s;
        font-weight: 500;
        color: var(--text-muted);
        cursor: pointer;
        font-size: 14px
    }

    .action-btn:hover {
        background: var(--blue-soft);
        color: var(--blue)
    }

    .action-btn i {
        font-size: 1rem;
        margin-right: .2rem
    }

    .like-btn i {
        color: #9ca3af;
        transition: all .3s
    }

    .like-btn.liked i {
        color: var(--blue);
        transform: scale(1.2)
    }

    .modal-content {
        border: none;
        box-shadow: 0 12px 40px rgba(0, 0, 0, .12)
    }

    /* ── COMPOSER ── */
    .sl-composer {
        background: var(--surface);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        margin-bottom: 1rem;
        overflow: hidden
    }

    .sl-tabs {
        display: flex;
        gap: 4px;
        padding: 10px 12px 0;
        border-bottom: 1px solid var(--cl-border)
    }

    .sl-tab {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 600;
        background: transparent;
        border: none;
        border-bottom: 2.5px solid transparent;
        border-radius: 8px 8px 0 0;
        color: var(--cl-text-sec);
        cursor: pointer;
        transition: all .2s;
        margin-bottom: -1px
    }

    .sl-tab:hover {
        color: var(--cl-primary);
        background: var(--cl-tag-bg)
    }

    .sl-tab.active {
        color: var(--cl-primary);
        border-bottom-color: var(--cl-primary);
        background: var(--cl-tag-bg)
    }

    .sl-tab svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0
    }

    .sl-panel {
        display: none;
        padding: 14px
    }

    .sl-panel.active {
        display: block;
        animation: slFadeIn .2s ease
    }

    @keyframes slFadeIn {
        from {
            opacity: 0;
            transform: translateY(4px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    .sl-user-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px
    }

    .sl-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
        font-size: 14px;
        overflow: hidden;
        background: var(--primary-gradient)
    }

    .sl-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .sl-user-info h5 {
        font-size: 13px;
        font-weight: 700;
        margin: 0 0 2px
    }

    .sl-audience {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--cl-primary);
        background: var(--cl-tag-bg);
        border: none;
        border-radius: 20px;
        padding: 2px 9px;
        cursor: pointer
    }

    .sl-caption {
        width: 100%;
        border: none;
        resize: none;
        font-size: 14.5px;
        color: var(--cl-text);
        min-height: 64px;
        outline: none;
        line-height: 1.6;
        margin-bottom: 10px
    }

    .sl-caption::placeholder {
        color: #bcc0c4
    }

    .sl-emoji-row {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 10px
    }

    .sl-emoji-row button {
        background: none;
        border: 1.5px solid var(--cl-border);
        border-radius: 7px;
        padding: 3px 6px;
        font-size: 14px;
        cursor: pointer;
        transition: all .15s
    }

    .sl-emoji-row button:hover {
        background: var(--cl-tag-bg);
        border-color: var(--cl-primary);
        transform: scale(1.12)
    }

    .sl-drop-zone {
        border: 2px dashed var(--cl-border);
        border-radius: 10px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        background: #fafafa;
        transition: all .2s;
        margin-bottom: 12px
    }

    .sl-drop-zone:hover {
        border-color: var(--cl-primary);
        background: var(--cl-tag-bg)
    }

    .sl-drop-zone svg {
        width: 28px;
        height: 28px;
        color: var(--cl-text-sec)
    }

    .sl-drop-zone span {
        font-size: 13px;
        font-weight: 700;
        color: var(--cl-text-sec)
    }

    .sl-drop-zone small {
        font-size: 11px;
        color: #bcc0c4
    }

    .sl-media-preview {
        display: none;
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 12px
    }

    .sl-media-preview img {
        width: 100%;
        display: block;
        max-height: 280px;
        object-fit: cover
    }

    .sl-remove-media {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0, 0, 0, .5);
        border: none;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        color: #fff;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .sl-friends-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--cl-text-sec);
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 7px;
        display: block
    }

    .sl-send-all-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
        background: #fafafa;
        border-radius: 8px;
        margin-bottom: 9px;
        border: 1.5px solid var(--cl-border)
    }

    .sl-send-all-row span {
        font-size: 13px;
        font-weight: 600
    }

    .sl-toggle {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px
    }

    .sl-toggle input {
        opacity: 0;
        width: 0;
        height: 0
    }

    .sl-slider {
        position: absolute;
        inset: 0;
        background: #ccd0d5;
        border-radius: 22px;
        cursor: pointer;
        transition: .3s
    }

    .sl-slider::before {
        content: '';
        position: absolute;
        height: 16px;
        width: 16px;
        left: 3px;
        bottom: 3px;
        background: #fff;
        border-radius: 50%;
        transition: .3s
    }

    .sl-toggle input:checked+.sl-slider {
        background: var(--cl-primary)
    }

    .sl-toggle input:checked+.sl-slider::before {
        transform: translateX(18px)
    }

    .sl-friends-list {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 12px
    }

    .sl-friend-chip {
        display: flex;
        align-items: center;
        gap: 5px;
        background: #fafafa;
        border: 1.5px solid var(--cl-border);
        border-radius: 20px;
        padding: 4px 11px;
        cursor: pointer;
        font-size: 12.5px;
        font-weight: 500;
        color: var(--cl-text-sec);
        transition: all .2s;
        user-select: none
    }

    .sl-friend-chip input {
        display: none
    }

    .sl-friend-chip.selected {
        background: var(--cl-tag-bg);
        border-color: var(--cl-primary);
        color: var(--cl-primary)
    }

    .sl-friend-chip .fc-av {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        background: var(--primary-gradient)
    }

    .sl-steps {
        display: flex;
        align-items: center;
        margin-bottom: 16px
    }

    .sl-step {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        color: var(--cl-text-sec)
    }

    .sl-step.active .sl-step-num {
        background: var(--cl-primary);
        color: #fff
    }

    .sl-step.done .sl-step-num {
        background: var(--cl-ans-bdr);
        color: #fff
    }

    .sl-step-num {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--cl-border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        flex-shrink: 0;
        transition: background .3s
    }

    .sl-step-line {
        flex: 1;
        height: 2px;
        background: var(--cl-border);
        margin: 0 7px
    }

    .sl-step-line.done {
        background: var(--cl-ans-bdr)
    }

    .sl-form-group {
        margin-bottom: 13px
    }

    .sl-form-group>label {
        display: block;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 4px;
        color: var(--cl-text);
        text-transform: uppercase;
        letter-spacing: .03em
    }

    .sl-hint {
        font-size: 11px;
        color: var(--cl-text-sec);
        margin-bottom: 4px
    }

    .sl-input {
        width: 100%;
        border: 1.5px solid var(--cl-border);
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 13.5px;
        color: var(--cl-text);
        outline: none;
        transition: border-color .2s;
        background: var(--cl-surface)
    }

    .sl-input:focus {
        border-color: var(--cl-primary)
    }

    .sl-rt-bar {
        display: flex;
        gap: 2px;
        padding: 5px 7px;
        background: #fafafa;
        border: 1.5px solid var(--cl-border);
        border-bottom: none;
        border-radius: 8px 8px 0 0
    }

    .sl-rt-btn {
        width: 26px;
        height: 26px;
        border: none;
        background: transparent;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--cl-text-sec);
        font-size: 12px;
        font-weight: 700;
        transition: background .15s
    }

    .sl-rt-btn:hover {
        background: var(--cl-border)
    }

    .sl-rt-area {
        border: 1.5px solid var(--cl-border);
        border-top: none;
        border-radius: 0 0 8px 8px;
        padding: 9px 12px;
        min-height: 90px;
        outline: none;
        font-size: 13.5px;
        line-height: 1.6
    }

    .sl-rt-area:focus {
        border-color: var(--cl-primary)
    }

    .sl-type-opts {
        display: flex;
        gap: 7px;
        margin-top: 5px
    }

    .sl-type-opt {
        flex: 1;
        padding: 9px 7px;
        border: 1.5px solid var(--cl-border);
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        transition: all .2s;
        font-size: 11.5px;
        font-weight: 700;
        color: var(--cl-text-sec);
        background: var(--cl-surface);
        text-align: center
    }

    .sl-type-opt svg {
        width: 18px;
        height: 18px
    }

    .sl-type-opt.selected {
        border-color: var(--cl-primary);
        background: var(--cl-tag-bg);
        color: var(--cl-primary)
    }

    .sl-tags-wrap {
        border: 1.5px solid var(--cl-border);
        border-radius: 8px;
        padding: 5px 9px;
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        cursor: text;
        transition: border-color .2s;
        min-height: 40px
    }

    .sl-tags-wrap:focus-within {
        border-color: var(--cl-primary)
    }

    .sl-tag-pill {
        display: flex;
        align-items: center;
        gap: 3px;
        background: var(--cl-tag-bg);
        color: var(--cl-tag-text);
        border-radius: 6px;
        padding: 2px 7px;
        font-size: 12px;
        font-weight: 700
    }

    .sl-tag-pill button {
        background: none;
        border: none;
        color: var(--cl-tag-text);
        cursor: pointer;
        font-size: 12px;
        padding: 0;
        line-height: 1
    }

    .sl-tag-input {
        border: none;
        outline: none;
        font-size: 13px;
        flex: 1;
        min-width: 80px;
        padding: 2px 0;
        background: transparent
    }

    .sl-visibility-row {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 8px 12px;
        background: #fafafa;
        border-radius: 8px;
        border: 1.5px solid var(--cl-border);
        font-size: 13px;
        font-weight: 600
    }

    .sl-visibility-row select {
        border: none;
        background: transparent;
        font-size: 13px;
        font-weight: 700;
        color: var(--cl-primary);
        cursor: pointer;
        outline: none
    }

    .sl-edit-notice {
        display: flex;
        gap: 9px;
        padding: 9px 12px;
        background: #fff8e1;
        border-left: 3px solid #f59e0b;
        border-radius: 6px;
        margin-bottom: 13px;
        font-size: 12px;
        color: #92400e;
        line-height: 1.5
    }

    .sl-edit-notice svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        color: #f59e0b;
        margin-top: 1px
    }

    .sl-action-bar {
        display: flex;
        justify-content: flex-end;
        gap: 7px;
        margin-top: 5px
    }

    .sl-btn {
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all .2s
    }

    .sl-btn-ghost {
        background: #f0f2f5;
        color: var(--cl-text-sec)
    }

    .sl-btn-ghost:hover {
        background: #e4e6ea
    }

    .sl-btn-primary {
        background: var(--blue);
        color: #fff
    }

    .sl-btn-primary:hover {
        background: var(--blue-d)
    }

    .sl-btn-primary:disabled {
        opacity: .45;
        cursor: not-allowed
    }

    .sl-char {
        text-align: right;
        font-size: 11px;
        color: var(--cl-text-sec);
        margin-top: 3px
    }

    /* ── Q&A FEED ── */
    .sl-q-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 2px 9px;
        border-radius: 20px;
        margin-bottom: 7px
    }

    .sl-q-badge svg {
        width: 11px;
        height: 11px
    }

    .sl-q-badge.troubleshoot {
        background: #fff0ea;
        color: #e7440d
    }

    .sl-q-badge.design {
        background: #f0e7ff;
        color: #7c3aed
    }

    .sl-q-badge.general {
        background: #e7f3ff;
        color: #1877f2
    }

    .sl-q-title {
        font-size: 15.5px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 7px;
        color: var(--text)
    }

    .sl-q-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 7px
    }

    .sl-q-tag {
        font-size: 12px;
        font-weight: 600;
        background: var(--blue-soft);
        color: var(--blue);
        padding: 2px 9px;
        border-radius: 6px
    }

    /* ── ANSWERS ── */
    .sl-answers {
        border-top: 1px solid #f0f2f5;
        display: none
    }

    .sl-answers-hdr {
        padding: 9px 14px 5px;
        font-size: 13px;
        font-weight: 700;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px
    }

    .sl-answers-hdr span {
        background: var(--blue);
        color: #fff;
        font-size: 10px;
        border-radius: 10px;
        padding: 1px 6px
    }

    .sl-answer-item {
        padding: 9px 14px;
        border-top: 1px solid #f0f2f5;
        display: flex;
        gap: 9px
    }

    .sl-a-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
        font-size: 11px;
        overflow: hidden;
        background: var(--primary-gradient)
    }

    .sl-a-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .sl-a-body {
        flex: 1;
        min-width: 0
    }

    .sl-a-bubble {
        background: #f5f7fa;
        border-radius: 10px;
        padding: 8px 12px;
        margin-bottom: 4px
    }

    .sl-a-bubble h5 {
        font-size: 12.5px;
        font-weight: 700;
        margin: 0 0 2px
    }

    .sl-a-bubble p {
        font-size: 13px;
        line-height: 1.6;
        color: #333;
        margin: 0
    }

    .sl-a-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 9px;
        font-size: 11.5px;
        color: var(--text-muted)
    }

    .sl-a-meta button {
        background: none;
        border: none;
        font-size: 11.5px;
        font-weight: 600;
        color: var(--text-muted);
        cursor: pointer;
        padding: 0
    }

    .sl-a-meta button:hover {
        color: var(--blue)
    }

    .sl-accepted-badge {
        color: var(--cl-ans-bdr);
        font-weight: 700
    }

    .sl-answer-item.accepted .sl-a-bubble {
        background: var(--cl-ans-bg);
        border: 1.5px solid var(--cl-ans-bdr)
    }

    .sl-replies {
        margin-top: 6px;
        padding-left: 12px;
        border-left: 2px solid #e5e7eb;
        display: none
    }

    .sl-reply {
        display: flex;
        gap: 6px;
        margin-top: 7px
    }

    .sl-r-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
        font-size: 8px;
        overflow: hidden;
        background: var(--primary-gradient)
    }

    .sl-r-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .sl-r-bubble {
        background: #f5f7fa;
        border-radius: 8px;
        padding: 6px 10px;
        flex: 1
    }

    .sl-r-bubble h6 {
        font-size: 11.5px;
        font-weight: 700;
        margin: 0 0 2px
    }

    .sl-r-bubble p {
        font-size: 11.5px;
        line-height: 1.5;
        color: #444;
        margin: 0
    }

    .sl-reply-compose {
        display: flex;
        gap: 5px;
        margin-top: 6px;
        align-items: center
    }

    .sl-reply-input {
        flex: 1;
        border: 1.5px solid #e5e7eb;
        border-radius: 20px;
        padding: 5px 11px;
        font-size: 12px;
        outline: none;
        transition: border-color .2s
    }

    .sl-reply-input:focus {
        border-color: var(--blue)
    }

    .sl-ans-composer {
        padding: 9px 14px;
        display: flex;
        gap: 9px;
        border-top: 1px solid #f0f2f5;
        align-items: flex-start
    }

    .sl-ans-input {
        width: 100%;
        border: 1.5px solid #e5e7eb;
        border-radius: 20px;
        padding: 8px 14px;
        font-size: 13px;
        color: var(--text);
        outline: none;
        transition: all .3s;
        resize: none;
        line-height: 1.5
    }

    .sl-ans-input:focus {
        border-color: var(--blue);
        border-radius: 10px;
        min-height: 68px
    }

    .sl-ans-input::placeholder {
        color: #bcc0c4
    }

    /* ── SEARCH / FILTER CARD ── */
    .filter-card {
        background: var(--surface);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: .85rem 1rem;
        margin-bottom: 1rem
    }

    .filter-card .form-control,
    .filter-card .form-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 13.5px;
        padding: .5rem .85rem;
        outline: none;
        transition: border-color .2s
    }

    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: var(--blue);
        box-shadow: none
    }
</style>

<div class="feed-container">
    <div class="container py-4">
        <div class="row">

            {{-- ══ LEFT SIDEBAR ══ --}}
            <div class="col-md-3 d-none d-md-block">
                <div class="sticky-sidebar">
                    <div class="profile-card mb-3">
                        <div class="card-body text-center">
                            @if(auth()->user()->profile_photo)
                            <img src="{{ Auth::user()->profile_photo ? Auth::user()->profile_photo : asset('images/default.png') }}"
                                class="rounded-circle profile-avatar mb-2" width="72" height="72" style="object-fit:cover;">
                            @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 bg-light" style="width:72px;height:72px;border:3px solid var(--blue)">
                                <i class="bi bi-person-fill fs-2 text-secondary"></i>
                            </div>
                            @endif
                            <h6 class="fw-bold mb-0">{{ auth()->user()->name }}</h6>
                            <p class="text-muted small mb-3" style="font-size:12.5px">{{ auth()->user()->bio ?? 'No bio yet' }}</p>
                            <hr class="my-2">
                            <a href="{{ route('posts.my') }}" class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-1"><i class="bi bi-file-earmark-post"></i> My Posts</a>
                            <a href="{{ url('/friends') }}" class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-1"><i class="bi bi-people-fill"></i> Friends</a>
                            <a href="{{ url('/skills') }}" class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-1"><i class="bi bi-lightbulb-fill"></i> My Skills</a>
                            <a href="{{ url('/roadmaps') }}" class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2"><i class="bi bi-map-fill"></i> Learning Roadmap</a>
                        </div>
                    </div>
                    <div class="news-card mb-3" id="dailyPuzzleCard">
                        <div class="card-body text-center">
                            <h6 class="fw-bold mb-3" style="font-size:13.5px">
                                <i class="bi bi-puzzle-fill me-2 text-primary"></i>Today's Puzzle
                            </h6>
                            <div id="puzzleContent">
                                <div class="text-muted small py-3">
                                    <div class="spinner-border spinner-border-sm text-primary mb-2" role="status"></div>
                                    <div>Loading today's puzzle…</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ CENTER FEED ══ --}}
            <div class="col-md-6">

                {{-- COMPOSER --}}
                <div class="sl-composer">
                    <div class="sl-tabs">
                        <button type="button" class="sl-tab active" data-panel="q-panel">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                <line x1="12" y1="17" x2="12.01" y2="17" />
                            </svg>
                            Ask Question
                        </button>
                        <button type="button" class="sl-tab" data-panel="edit-panel">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Edit Question
                        </button>
                    </div>

                    {{-- TAB 1: ASK QUESTION --}}
                    <div id="q-panel" class="sl-panel active">
                        <form id="qForm" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="post_type" value="question">
                            <input type="hidden" name="q_type" id="qTypeHidden" value="troubleshoot">
                            <input type="hidden" name="content" id="qContentHidden">
                            <input type="hidden" name="tags" id="qTagsHidden">
                            <input type="hidden" name="title" id="qTitleHidden">

                            <div class="sl-steps">
                                <div class="sl-step active" id="qsi-1">
                                    <div class="sl-step-num" id="qsn-1">1</div>&nbsp;Summarize
                                </div>
                                <div class="sl-step-line" id="qsl-1"></div>
                                <div class="sl-step" id="qsi-2">
                                    <div class="sl-step-num" id="qsn-2">2</div>&nbsp;Details
                                </div>
                                <div class="sl-step-line" id="qsl-2"></div>
                                <div class="sl-step" id="qsi-3">
                                    <div class="sl-step-num" id="qsn-3">3</div>&nbsp;Type &amp; Tags
                                </div>
                            </div>

                            <div id="qs1">
                                <div class="sl-form-group">
                                    <label>Question Title <span style="color:var(--cl-accent)">*</span></label>
                                    <div class="sl-hint">Be specific — imagine asking a real expert. (Min 15 characters)</div>
                                    <input class="sl-input" id="qTitle" type="text" maxlength="200" placeholder="e.g. How to optimize responsive layout for high-traffic sites?">
                                    <div class="sl-char" id="qTitleCount">0 / 200</div>
                                </div>
                                <div class="sl-action-bar">
                                    <button type="button" class="sl-btn sl-btn-primary" id="qNext1" disabled>Next &#8594;</button>
                                </div>
                            </div>

                            <div id="qs2" style="display:none">
                                <div class="sl-form-group">
                                    <label>Describe the Problem <span style="color:var(--cl-accent)">*</span></label>
                                    <div class="sl-hint">Include context, what you've tried, expected vs actual results. (Min 50 chars)</div>
                                    <div class="sl-rt-bar" id="qRtBar">
                                        <button type="button" class="sl-rt-btn" data-cmd="bold"><b>B</b></button>
                                        <button type="button" class="sl-rt-btn" data-cmd="italic"><i>I</i></button>
                                        <button type="button" class="sl-rt-btn" data-cmd="underline"><u>U</u></button>
                                        <button type="button" class="sl-rt-btn" data-cmd="formatBlock" data-val="pre" style="font-family:monospace">&lt;/&gt;</button>
                                        <button type="button" class="sl-rt-btn" data-cmd="insertUnorderedList">&#8801;</button>
                                        <button type="button" class="sl-rt-btn" data-cmd="insertOrderedList">1.</button>
                                    </div>
                                    <div class="sl-rt-area" id="qBody" contenteditable="true"></div>
                                    <div class="sl-char" id="qBodyCount">0 / 5000</div>
                                </div>
                                <div class="sl-action-bar">
                                    <button type="button" class="sl-btn sl-btn-ghost" id="qBack1">&#8592; Back</button>
                                    <button type="button" class="sl-btn sl-btn-primary" id="qNext2" disabled>Next &#8594;</button>
                                </div>
                            </div>

                            <div id="qs3" style="display:none">
                                <div class="sl-form-group">
                                    <label>Question Type <span style="color:var(--cl-accent)">*</span></label>
                                    <div class="sl-type-opts">
                                        <button type="button" class="sl-type-opt ask-type-opt selected" data-type="troubleshoot">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="12" y1="8" x2="12" y2="12" />
                                                <line x1="12" y1="16" x2="12.01" y2="16" />
                                            </svg>
                                            Troubleshooting
                                        </button>
                                        <button type="button" class="sl-type-opt ask-type-opt" data-type="design">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                            </svg>
                                            Design Advice
                                        </button>
                                        <button type="button" class="sl-type-opt ask-type-opt" data-type="general">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                                <line x1="12" y1="17" x2="12.01" y2="17" />
                                            </svg>
                                            General Q&amp;A
                                        </button>
                                    </div>
                                </div>
                                <div class="sl-form-group">
                                    <label>Tags <span class="sl-hint d-inline">(up to 5, press Enter)</span></label>
                                    <div class="sl-tags-wrap" id="qTagsWrap">
                                        <input class="sl-tag-input" name="qTagIn" id="qTagIn" placeholder="Add a tag…">
                                    </div>
                                </div>
                                <div class="sl-form-group">
                                    <label>Visibility</label>
                                    <div class="sl-visibility-row">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="2" y1="12" x2="22" y2="12" />
                                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                                        </svg>
                                        <select name="type">
                                            <option value="public">Public – Everyone can answer</option>
                                            <option value="friends">Friends – Mutual friends only</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="sl-action-bar">
                                    <button type="button" class="sl-btn sl-btn-ghost" id="qBack2">&#8592; Back</button>
                                    <button type="submit" class="sl-btn sl-btn-primary" id="qSubmitBtn">
                                        <i class="bi bi-send-fill me-1"></i> Post Question
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- TAB 2: EDIT QUESTION --}}
                    <div id="edit-panel" class="sl-panel">
                        <div class="sl-form-group">
                            <label>Select your question to edit</label>
                            <select class="sl-input" id="editPostSelector">
                                <option value="">— Choose a post —</option>
                                @foreach($posts as $post)
                                @if(auth()->id() === $post->user_id)
                                <option value="{{ $post->id }}">{{ Str::limit($post->title ?? strip_tags($post->content), 70) }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div id="editFormWrap" style="display:none">
                            @foreach($posts as $post)
                            @if(auth()->id() === $post->user_id || auth()->user()->role === 'admin')
                            <form id="editForm-{{ $post->id }}" class="sl-edit-form" style="display:none"
                                method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                                @csrf @method('PUT')

                                {{-- ✅ FIX: Preserve post_type and type so they are never null --}}
                                <input type="hidden" name="post_type" value="{{ $post->post_type ?? 'question' }}">
                                <input type="hidden" name="type" value="{{ $post->type ?? 'public' }}">
                                {{-- q_type is sent via hidden input updated by the type selector buttons below --}}
                                <input type="hidden" name="q_type" id="editQTypeHidden-{{ $post->id }}" value="{{ $post->q_type ?? 'general' }}">

                                <div class="sl-edit-notice">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="12" y1="8" x2="12" y2="12" />
                                        <line x1="12" y1="16" x2="12.01" y2="16" />
                                    </svg>
                                    Your edit will be placed in a review queue. Please make the post clearer and more valuable.
                                </div>

                                <div class="sl-form-group">
                                    <label>Title</label>
                                    <input class="sl-input" type="text" name="title" value="{{ $post->title ?? '' }}" placeholder="Question title…">
                                </div>

                                <div class="sl-form-group">
                                    <label>Body <span style="color:var(--cl-accent)">*</span></label>
                                    <div class="sl-rt-bar">
                                        <button type="button" class="sl-rt-btn" data-cmd="bold"><b>B</b></button>
                                        <button type="button" class="sl-rt-btn" data-cmd="italic"><i>I</i></button>
                                        <button type="button" class="sl-rt-btn" data-cmd="underline"><u>U</u></button>
                                        <button type="button" class="sl-rt-btn" data-cmd="formatBlock" data-val="pre" style="font-family:monospace">&lt;/&gt;</button>
                                        <button type="button" class="sl-rt-btn" data-cmd="insertUnorderedList">&#8801;</button>
                                        <button type="button" class="sl-rt-btn" data-cmd="insertOrderedList">1.</button>
                                    </div>
                                    <div class="sl-rt-area" id="editBody-{{ $post->id }}" contenteditable="true">{!! $post->content !!}</div>
                                    <input type="hidden" name="content" id="editBodyHidden-{{ $post->id }}">
                                </div>

                                @if($post->media)
                                <div class="mb-2 text-center" id="editOldImg-{{ $post->id }}">
                                    <img src="{{ asset('storage/' . $post->media) }}" class="img-fluid rounded-3" style="max-height:180px;">
                                </div>
                                @endif
                                <div class="mb-2 text-center d-none" id="editNewImgBox-{{ $post->id }}">
                                    <img src="" class="img-fluid rounded-3" style="max-height:180px;" id="editNewImg-{{ $post->id }}">
                                </div>

                                {{-- ✅ FIX: Question Type selector — user can change q_type here --}}
                                @if(!empty($post->post_type) && $post->post_type === 'question')
                                <div class="sl-form-group">
                                    <label>Question Type</label>
                                    <div class="sl-type-opts edit-type-opts" data-post="{{ $post->id }}">
                                        <button type="button"
                                            class="sl-type-opt edit-type-opt {{ ($post->q_type ?? 'general') === 'troubleshoot' ? 'selected' : '' }}"
                                            data-type="troubleshoot" data-post="{{ $post->id }}">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="12" y1="8" x2="12" y2="12" />
                                                <line x1="12" y1="16" x2="12.01" y2="16" />
                                            </svg>
                                            Troubleshooting
                                        </button>
                                        <button type="button"
                                            class="sl-type-opt edit-type-opt {{ ($post->q_type ?? 'general') === 'design' ? 'selected' : '' }}"
                                            data-type="design" data-post="{{ $post->id }}">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                            </svg>
                                            Design Advice
                                        </button>
                                        <button type="button"
                                            class="sl-type-opt edit-type-opt {{ ($post->q_type ?? 'general') === 'general' ? 'selected' : '' }}"
                                            data-type="general" data-post="{{ $post->id }}">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                                <line x1="12" y1="17" x2="12.01" y2="17" />
                                            </svg>
                                            General Q&amp;A
                                        </button>
                                    </div>
                                </div>
                                @endif

                                <div class="sl-form-group">
                                    <label>Tags</label>
                                    <div class="sl-tags-wrap" id="editTagsWrap-{{ $post->id }}">
                                        @if(!empty($post->tags))
                                        @foreach(explode(',', $post->tags) as $t)
                                        <span class="sl-tag-pill">{{ trim($t) }} <button type="button" class="remove-tag-btn">&#215;</button></span>
                                        @endforeach
                                        @endif
                                        <input class="sl-tag-input edit-tag-input" id="editTagIn-{{ $post->id }}"
                                            data-wrap="editTagsWrap-{{ $post->id }}" data-hidden="editTagsHidden-{{ $post->id }}"
                                            placeholder="Add a tag…">
                                    </div>
                                    <input type="hidden" name="tags" id="editTagsHidden-{{ $post->id }}" value="{{ $post->tags }}">
                                </div>

                                <div class="sl-form-group">
                                    <label>Edit Summary</label>
                                    <input class="sl-input" type="text" name="edit_summary" placeholder="Corrected spelling, improved formatting…">
                                </div>

                                <div class="sl-action-bar">
                                    <button type="button" class="sl-btn sl-btn-ghost edit-cancel-btn">Cancel</button>
                                    <button type="submit" class="sl-btn sl-btn-primary edit-save-btn" data-post="{{ $post->id }}">
                                        <i class="bi bi-check-lg me-1"></i> Save Edits
                                    </button>
                                </div>
                            </form>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>{{-- /sl-composer --}}

                {{-- SEARCH + TAG FILTER --}}
                <div class="filter-card">
                    <form method="GET" action="{{ route('feed') }}" id="filterForm" style="display:flex;gap:10px;align-items:center;">
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            placeholder="🔍  Search posts…" class="form-control">
                        <select name="tag" id="tagFilter" class="form-select" style="max-width:180px;">
                            <option value="">Filter by Tag</option>
                            @foreach($allTags as $tag)
                            <option value="{{ $tag }}" {{ request('tag') == $tag ? 'selected' : '' }}>{{ $tag }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                {{-- POSTS FEED --}}
                @forelse($posts as $post)
                <div class="post-card">
                    <div class="post-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                @if($post->user->profile_photo)
                                <img src="{{ $post->user->profile_photo ? $post->user->profile_photo : asset('images/default.png') }}"
                                    width="44" height="44" class="rounded-circle" style="object-fit:cover;border:2px solid #e5e7eb;">
                                @else
                                <div class="d-flex align-items-center justify-content-center rounded-circle bg-light" style="width:44px;height:44px;border:2px solid #e5e7eb;">
                                    <i class="bi bi-person-fill text-secondary"></i>
                                </div>
                                @endif
                                <div>
                                    <h6 class="fw-bold mb-0" style="font-size:14.5px">{{ $post->title }}</h6>
                                    <small class="text-muted" style="font-size:12px">
                                        <i class="bi bi-clock"></i> {{ $post->user->name }} &bull; {{ $post->created_at->diffForHumans() }}
                                        @if(!empty($post->post_type) && $post->post_type === 'question')
                                        &nbsp;<span class="badge bg-light text-secondary border" style="font-size:10px">Question</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                            @if(auth()->id() === $post->user_id || auth()->user()->role === 'admin')
                            <div class="dropdown">
                                <button class="btn btn-light rounded-circle p-1" data-bs-toggle="dropdown" type="button" style="width:32px;height:32px;">
                                    <i class="bi bi-three-dots-vertical" style="font-size:13px"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                    <li><button type="button" class="dropdown-item open-edit-tab-btn" data-post="{{ $post->id }}"><i class="bi bi-pencil me-2"></i>Edit</button></li>
                                    <li>
                                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                            @csrf @method('DELETE')
                                            <button class="dropdown-item text-danger" type="submit"><i class="bi bi-trash me-2"></i>Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body px-3 py-2">
                        @if(!empty($post->post_type) && $post->post_type === 'question')
                        @php
                        $badgeClass = match($post->q_type ?? 'general') { 'troubleshoot'=>'troubleshoot','design'=>'design',default=>'general' };
                        $badgeLabel = match($post->q_type ?? 'general') { 'troubleshoot'=>'Troubleshooting / Debugging','design'=>'Design Advice',default=>'General Q&A' };
                        @endphp
                        <div class="sl-q-badge {{ $badgeClass }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            {{ $badgeLabel }}
                        </div>
                        @if(!empty($post->title))
                        <div class="sl-q-title">{{ $post->title }}</div>
                        @endif
                        @endif
                        <p class="card-text mb-0" style="font-size:14px">{!! $post->content !!}</p>
                        @if(!empty($post->tags))
                        <div class="sl-q-tags mt-2">
                            @foreach(explode(',', $post->tags) as $tag)
                            <span class="sl-q-tag">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    @if($post->media)
                    <div class="post-media-wrapper" style="width:100%;height:400px;display:flex;align-items:center;justify-content:center;">
                        <img src="{{ asset('storage/' . $post->media) }}" style="width:100%;height:100%;object-fit:cover;object-position:center;" alt="Post media">
                    </div>
                    @endif

                    {{-- CARD FOOTER --}}
                    <div class="card-footer bg-white border-0 py-2 px-3">
                        <div class="d-flex justify-content-around">
                            <button type="button" class="action-btn like-btn {{ $post->likes->where('user_id', auth()->id())->count() ? 'liked' : '' }}" data-post="{{ $post->id }}">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                <span class="like-count">{{ $post->likes_count }}</span>
                            </button>
                            <button type="button" class="action-btn toggle-answers-btn" data-post="{{ $post->id }}" data-target="answers-{{ $post->id }}">
                                <i class="bi bi-chat-fill"></i>
                                {{ (!empty($post->post_type) && $post->post_type === 'question') ? 'Answer' : 'Comment' }}
                                <span class="ms-1 text-muted small" id="commentCount-{{ $post->id }}">({{ $post->comments_count }})</span>
                            </button>
                            <button type="button" class="action-btn" data-bs-toggle="modal" data-bs-target="#shareModal-{{ $post->id }}">
                                <i class="bi bi-share-fill"></i> Share
                            </button>
                        </div>
                        @php
                        $likeCount = $post->likes_count;
                        $likedUsers = $post->likes->take(2);
                        $remainingLikes = $likeCount - 2;
                        @endphp
                        @if($likeCount > 0)
                        <div class="px-2 pb-1 small text-muted" id="likeText-{{ $post->id }}" style="font-size:12px">
                            Liked by
                            @foreach($likedUsers as $like) {{ $like->user->name }}@if(!$loop->last), @endif @endforeach
                            @if($remainingLikes > 0)
                            and <a href="#" class="text-dark fw-semibold text-decoration-none show-likes" data-post="{{ $post->id }}" data-bs-toggle="modal" data-bs-target="#likesModal-{{ $post->id }}">{{ $remainingLikes }} others</a>
                            @endif
                        </div>
                        @endif
                    </div>

                    {{-- COMMENTS PANEL --}}
                    <div class="sl-answers" id="answers-{{ $post->id }}" style="display:none;">
                        <div class="sl-answers-hdr">
                            {{ (!empty($post->post_type) && $post->post_type === 'question') ? 'Answers' : 'Comments' }}
                            <span id="answersCount-{{ $post->id }}">{{ $post->comments_count }}</span>
                        </div>
                        <div id="commentsList-{{ $post->id }}"></div>
                        <div style="display:flex;gap:8px;align-items:center;padding:9px 14px;border-top:1px solid #f0f2f5;">
                            <div class="sl-a-avatar">
                                @if(auth()->user()->profile_photo)
                                <img src="{{ Auth::user()->profile_photo ? Auth::user()->profile_photo : asset('images/default.png') }}" alt="">
                                @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                @endif
                            </div>
                            <input class="sl-reply-input main-comment-input" type="text" data-post="{{ $post->id }}"
                                placeholder="Write a {{ (!empty($post->post_type) && $post->post_type === 'question') ? 'answer' : 'comment' }}…" style="flex:1;">
                            <button class="sl-btn sl-btn-primary main-comment-btn" data-post="{{ $post->id }}" style="padding:5px 13px;font-size:12.5px;white-space:nowrap;">Post</button>
                        </div>
                    </div>

                    {{-- SHARE MODAL --}}
                    <div class="modal fade" id="shareModal-{{ $post->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="fw-bold mb-0"><i class="bi bi-share-fill me-2"></i>Share post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <a href="https://wa.me/?text={{ urlencode(url('/posts/'.$post->id)) }}" target="_blank" class="btn btn-success w-100 mb-3 rounded-pill py-2">
                                        <i class="bi bi-whatsapp me-2"></i> Share on WhatsApp
                                    </a>
                                    <hr>
                                    <h6 class="small fw-bold text-muted mb-3"><i class="bi bi-people-fill me-2"></i>Share with friends</h6>
                                    @foreach($friends as $friend)
                                    <form method="POST" action="{{ route('posts.share.friend', [$post->id, $friend->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-light w-100 text-start mb-2 rounded-pill py-2">
                                            @if($friend->profile_photo)<img src="{{ asset('' . $friend->profile_photo) }}" width="32" height="32" class="rounded-circle me-2">@endif
                                            {{ $friend->name }}
                                        </button>
                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- LIKES MODAL --}}
                    <div class="modal fade" id="likesModal-{{ $post->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4">
                                <div class="modal-header border-0">
                                    <h5 class="fw-bold mb-0"><i class="bi bi-hand-thumbs-up-fill me-2 text-primary"></i>Liked by</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body" id="likesList-{{ $post->id }}">
                                    @forelse($post->likes as $like)
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        @if($like->user->profile_photo)
                                        <img src="{{ asset('storage/' . $like->user->profile_photo) }}" width="38" height="38" class="rounded-circle" style="object-fit:cover">
                                        @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:38px;height:38px;"><i class="bi bi-person-fill text-secondary"></i></div>
                                        @endif
                                        <span class="fw-semibold">{{ $like->user->name }}</span>
                                    </div>
                                    @empty
                                    <p class="text-muted text-center">No likes yet</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>{{-- /post-card --}}
                @empty
                <div class="post-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-inbox fs-1 text-muted mb-3 d-block"></i>
                        <h5 class="text-muted">No posts yet</h5>
                        <p class="text-muted small">Follow friends to see their posts here, or create your first post!</p>
                        @if(request('search'))<p class="small">No results for "<strong>{{ request('search') }}</strong>"</p>@endif
                        @if(request('tag'))<p class="small">No posts under tag "<strong>#{{ request('tag') }}</strong>"</p>@endif
                    </div>
                </div>
                @endforelse

                <div class="mt-3">{{ $posts->links() }}</div>
            </div>{{-- /col center --}}

            {{-- ══ RIGHT SIDEBAR ══ --}}
            <div class="col-md-3 d-none d-lg-block">
                <div class="sticky-sidebar">
                    <div class="news-card mb-3" id="smartNewsCard">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3" style="font-size:13.5px">
                                <i class="bi bi-newspaper me-2 text-primary"></i>Smart Learners News
                            </h6>
                            <ul class="list-unstyled mb-0" id="newsFeed"
                               style="max-height:300px;overflow-y:auto;scrollbar-width:none;padding-right:2px;">
                                <li class="text-muted small text-center py-2">
                                    <div class="spinner-border spinner-border-sm text-primary mb-1" role="status"></div>
                                    <div>Loading news…</div>
                                </li>
                            </ul>
                            <small class="text-muted d-block mt-2" style="font-size:10.5px">
                                Refreshes in <span id="newsCountdown">--</span>
                            </small>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body text-center" style="font-size:12.5px">
                            <p class="fw-semibold text-primary mb-2">Smart Social Learning Platform</p>
                            <div class="d-flex flex-wrap justify-content-center gap-2 mb-2">
                                <a href="{{ route('about') }}" class="text-decoration-none text-muted">About</a><span class="text-muted">&#8226;</span>
                                <a href="{{ route('contact') }}" class="text-decoration-none text-muted">Contact</a><span class="text-muted">&#8226;</span>
                                <a href="{{ route('privacy') }}" class="text-decoration-none text-muted">Privacy</a><span class="text-muted">&#8226;</span>
                                <a href="{{ route('terms') }}" class="text-decoration-none text-muted">Terms</a>
                            </div>
                            <small class="text-muted">&copy; {{ date('Y') }} SmartLearn</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<input type="hidden" id="sessionFormType" value="{{ session('form_type') }}">
<input type="hidden" id="sessionEditId" value="{{ session('edit_post_id') }}">

<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    document.addEventListener('DOMContentLoaded', function() {

        // ── TAB SWITCHING ──
        document.querySelectorAll('.sl-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.sl-panel').forEach(function(p) {
                    p.classList.remove('active');
                });
                document.querySelectorAll('.sl-tab').forEach(function(t) {
                    t.classList.remove('active');
                });
                document.getElementById(this.dataset.panel).classList.add('active');
                this.classList.add('active');
            });
        });

        // ── ASK QUESTION STEPS ──
        var qCurrent = 1;

        function qGoStep(n) {
            document.getElementById('qs' + qCurrent).style.display = 'none';
            for (var i = 1; i < n; i++) {
                document.getElementById('qsi-' + i).classList.remove('active');
                document.getElementById('qsi-' + i).classList.add('done');
                document.getElementById('qsn-' + i).textContent = '✓';
                var ln = document.getElementById('qsl-' + i);
                if (ln) ln.classList.add('done');
            }
            document.getElementById('qsi-' + n).classList.remove('done');
            document.getElementById('qsi-' + n).classList.add('active');
            document.getElementById('qsn-' + n).textContent = n;
            document.getElementById('qs' + n).style.display = 'block';
            qCurrent = n;
        }
        var qTitleInput = document.getElementById('qTitle');
        var qNext1 = document.getElementById('qNext1');
        if (qTitleInput && qNext1) {
            function validateTitle() {
                var length = qTitleInput.value.trim().length;
                document.getElementById('qTitleCount').innerText = length + ' / 200';
                qNext1.disabled = length < 15;
                qNext1.style.opacity = length >= 15 ? '1' : '0.5';
            }
            qTitleInput.addEventListener('input', validateTitle);
            validateTitle();
        }
        var qBody = document.getElementById('qBody');
        var qNext2 = document.getElementById('qNext2');
        if (qBody) {
            qBody.addEventListener('input', function() {
                var len = this.innerText.trim().length;
                document.getElementById('qBodyCount').textContent = len + ' / 5000';
                if (qNext2) qNext2.disabled = len < 50;
            });
        }
        if (qNext1) qNext1.addEventListener('click', function() {
            qGoStep(2);
        });
        if (qNext2) qNext2.addEventListener('click', function() {
            qGoStep(3);
        });
        var qBack1 = document.getElementById('qBack1');
        var qBack2 = document.getElementById('qBack2');
        if (qBack1) qBack1.addEventListener('click', function() {
            qGoStep(1);
        });
        if (qBack2) qBack2.addEventListener('click', function() {
            qGoStep(2);
        });

        // ── ASK QUESTION RICH TEXT ──
        var qRtBar = document.getElementById('qRtBar');
        if (qRtBar) {
            qRtBar.addEventListener('click', function(e) {
                var btn = e.target.closest('.sl-rt-btn');
                if (!btn) return;
                e.preventDefault();
                document.execCommand(btn.dataset.cmd, false, btn.dataset.val || null);
            });
        }

        // ── ✅ FIX: TYPE OPTION BUTTONS — scoped correctly for Ask vs Edit ──
        document.querySelectorAll('.sl-type-opt').forEach(function(opt) {
            opt.addEventListener('click', function() {
                var postId = this.dataset.post; // only edit buttons have data-post

                if (postId) {
                    // Edit form — only deselect siblings for THIS post's buttons
                    document.querySelectorAll('.edit-type-opt[data-post="' + postId + '"]').forEach(function(o) {
                        o.classList.remove('selected');
                    });
                    this.classList.add('selected');
                    // Update the hidden q_type input for this specific edit form
                    var hidden = document.getElementById('editQTypeHidden-' + postId);
                    if (hidden) hidden.value = this.dataset.type;
                } else {
                    // Ask Question form — only deselect ask-form buttons
                    document.querySelectorAll('.ask-type-opt').forEach(function(o) {
                        o.classList.remove('selected');
                    });
                    this.classList.add('selected');
                    var hidden = document.getElementById('qTypeHidden');
                    if (hidden) hidden.value = this.dataset.type;
                }
            });
        });

        // ── ASK QUESTION TAGS ──
        var qTagIn = document.getElementById('qTagIn');
        if (qTagIn) {
            qTagIn.addEventListener('keydown', function(e) {
                addTagToWrap(e, 'qTagsWrap', 'qTagsHidden');
            });
        }

        // ── ASK QUESTION FORM SUBMIT ──
        var qForm = document.getElementById('qForm');
        if (qForm) {
            qForm.addEventListener('submit', function() {
                var th = document.getElementById('qTitleHidden');
                var ch = document.getElementById('qContentHidden');
                var gh = document.getElementById('qTagsHidden');
                if (th) th.value = document.getElementById('qTitle').value;
                if (ch && qBody) ch.value = qBody.innerHTML.trim();
                if (gh) gh.value = collectTags('qTagsWrap');
            });
        }

        // ── EDIT FORM: SELECTOR ──
        var editSelector = document.getElementById('editPostSelector');

        function loadEditForm(postId) {
            document.querySelectorAll('.sl-edit-form').forEach(function(f) {
                f.style.display = 'none';
            });
            var wrap = document.getElementById('editFormWrap');
            if (!postId) {
                if (wrap) wrap.style.display = 'none';
                return;
            }
            if (wrap) wrap.style.display = 'block';
            var form = document.getElementById('editForm-' + postId);
            if (form) form.style.display = 'block';
        }
        if (editSelector) {
            editSelector.addEventListener('change', function() {
                loadEditForm(this.value);
            });
        }

        // ── EDIT FORM: RICH TEXT BARS ──
        document.querySelectorAll('.sl-edit-form .sl-rt-bar').forEach(function(bar) {
            bar.addEventListener('click', function(e) {
                var btn = e.target.closest('.sl-rt-btn');
                if (!btn) return;
                e.preventDefault();
                document.execCommand(btn.dataset.cmd, false, btn.dataset.val || null);
            });
        });

        // ── EDIT FORM: TAG INPUTS ──
        document.querySelectorAll('.edit-tag-input').forEach(function(inp) {
            inp.addEventListener('keydown', function(e) {
                addTagToWrap(e, inp.dataset.wrap, inp.dataset.hidden);
            });
        });

        // ── EDIT FORM: IMAGE PREVIEW ──
        document.querySelectorAll('.edit-img-input').forEach(function(inp) {
            inp.addEventListener('change', function() {
                var postId = this.dataset.post;
                var r = new FileReader();
                r.onload = function(ev) {
                    var ni = document.getElementById('editNewImg-' + postId);
                    var nb = document.getElementById('editNewImgBox-' + postId);
                    var ob = document.getElementById('editOldImg-' + postId);
                    if (ni) ni.src = ev.target.result;
                    if (nb) nb.classList.remove('d-none');
                    if (ob) ob.classList.add('d-none');
                };
                if (this.files[0]) r.readAsDataURL(this.files[0]);
            });
        });

        // ── EDIT FORM: SAVE BUTTON — sync hidden fields before submit ──
        document.querySelectorAll('.edit-save-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var postId = this.dataset.post;
                var body = document.getElementById('editBody-' + postId);
                var hidden = document.getElementById('editBodyHidden-' + postId);
                if (body && hidden) hidden.value = body.innerHTML.trim();
                var tagHidden = document.getElementById('editTagsHidden-' + postId);
                if (tagHidden) tagHidden.value = collectTags('editTagsWrap-' + postId);
                // q_type is already kept in sync via the type button click handler above
            });
        });

        // ── EDIT FORM: CANCEL ──
        document.querySelectorAll('.edit-cancel-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                if (editSelector) editSelector.value = '';
                loadEditForm('');
            });
        });

        // ── OPEN EDIT TAB FROM POST DROPDOWN ──
        document.querySelectorAll('.open-edit-tab-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var postId = this.dataset.post;
                document.querySelectorAll('.sl-panel').forEach(function(p) {
                    p.classList.remove('active');
                });
                document.querySelectorAll('.sl-tab').forEach(function(t) {
                    t.classList.remove('active');
                });
                document.getElementById('edit-panel').classList.add('active');
                var editTab = document.querySelector('.sl-tab[data-panel="edit-panel"]');
                if (editTab) editTab.classList.add('active');
                if (editSelector) {
                    editSelector.value = postId;
                    loadEditForm(postId);
                }
                var composer = document.querySelector('.sl-composer');
                if (composer) composer.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // ── TAG HELPERS ──
        function addTagToWrap(e, wrapId, hiddenId) {
            if (e.key !== 'Enter' && e.key !== ',') return;
            e.preventDefault();
            var val = e.target.value.replace(/,/g, '').trim();
            if (!val) return;
            var wrap = document.getElementById(wrapId);
            if (!wrap) return;
            if (wrap.querySelectorAll('.sl-tag-pill').length >= 5) {
                alert('Max 5 tags');
                return;
            }
            var pill = document.createElement('span');
            pill.className = 'sl-tag-pill';
            pill.innerHTML = val + ' <button type="button" class="remove-tag-btn">&#215;</button>';
            wrap.insertBefore(pill, e.target);
            e.target.value = '';
            var h = document.getElementById(hiddenId);
            if (h) h.value = collectTags(wrapId);
        }

        function collectTags(wrapId) {
            var wrap = document.getElementById(wrapId);
            if (!wrap) return '';
            return Array.from(wrap.querySelectorAll('.sl-tag-pill')).map(function(p) {
                return p.textContent.replace('×', '').trim();
            }).join(',');
        }

        // ── SESSION RESTORE (redirect back to edit tab) ──
        var formType = document.getElementById('sessionFormType')?.value;
        var editPostId = document.getElementById('sessionEditId')?.value;
        if (formType === 'edit') {
            var editTabBtn = document.querySelector('.sl-tab[data-panel="edit-panel"]');
            if (editTabBtn) editTabBtn.click();
            if (editSelector && editPostId) {
                editSelector.value = editPostId;
                loadEditForm(editPostId);
            }
        }

        // ── FILTER FORM ──
        const form = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
        const tagFilter = document.getElementById('tagFilter');
        if (form) {
            if (tagFilter) {
                tagFilter.addEventListener('change', function() {
                    form.submit();
                });
            }
            if (searchInput) {
                let typingTimer;
                searchInput.addEventListener('keyup', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(() => {
                        form.submit();
                    }, 500);
                });
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        form.submit();
                    }
                });
            }
        }

        // ── EDIT TAG INPUT: keyup enter fallback ──
        document.querySelectorAll('.edit-tag-input').forEach(function(input) {
            input.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const hiddenId = input.dataset.hidden;
                    const hidden = document.getElementById(hiddenId);
                    let current = hidden.value ? hidden.value.split(',') : [];
                    let tag = input.value.trim();
                    if (tag && !current.includes(tag)) {
                        current.push(tag);
                        hidden.value = current.join(',');
                        input.value = '';
                    }
                }
            });
        });
    });

    // ── GLOBAL CLICK HANDLER ──
    document.addEventListener('click', function(e) {

        // Remove tag pill
        if (e.target.classList.contains('remove-tag-btn')) {
            var pill = e.target.closest('.sl-tag-pill');
            if (pill) pill.remove();
            return;
        }

        // Like button
        var likeBtn = e.target.closest('.like-btn');
        if (likeBtn) {
            if (likeBtn.disabled) return;
            likeBtn.disabled = true;
            var postId = likeBtn.dataset.post;
            fetch('/posts/' + postId + '/like', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    }
                })
                .then(function(r) {
                    return r.json();
                })
                .then(function(data) {
                    likeBtn.querySelector('.like-count').innerText = data.likes_count;
                    likeBtn.classList.toggle('liked', data.liked);
                    var likeText = document.getElementById('likeText-' + postId);
                    if (!likeText) return;
                    if (data.likes_count === 0) {
                        likeText.innerHTML = '';
                        return;
                    }
                    var users = data.top_users;
                    var text = 'Liked by ';
                    if (data.likes_count === 1) {
                        text += users[0];
                    } else if (data.likes_count === 2) {
                        text += users[0] + ', ' + users[1];
                    } else {
                        text += users[0] + ', ' + users[1] + ' and <a href="#" class="text-dark fw-semibold text-decoration-none show-likes" data-post="' + postId + '" data-bs-toggle="modal" data-bs-target="#likesModal-' + postId + '">' + data.remaining + ' others</a>';
                    }
                    likeText.innerHTML = text;
                })
                .catch(function(err) {
                    console.error('Like failed:', err);
                })
                .finally(function() {
                    likeBtn.disabled = false;
                });
            return;
        }

        // Show likes modal
        var showLikes = e.target.closest('.show-likes');
        if (showLikes) {
            loadLikesModal(showLikes.dataset.post);
            return;
        }

        // Toggle answers/comments panel
        var toggleBtn = e.target.closest('.toggle-answers-btn');
        if (toggleBtn) {
            var postId = toggleBtn.dataset.post;
            var panel = document.getElementById(toggleBtn.dataset.target);
            if (!panel) return;
            var opening = window.getComputedStyle(panel).display === 'none';
            panel.style.display = opening ? 'block' : 'none';
            if (opening && !panel.dataset.loaded) {
                loadComments(postId);
                panel.dataset.loaded = '1';
            }
            return;
        }

        // Post main comment
        var mainBtn = e.target.closest('.main-comment-btn');
        if (mainBtn) {
            var postId = mainBtn.dataset.post;
            var input = document.querySelector('.main-comment-input[data-post="' + postId + '"]');
            var text = input ? input.value.trim() : '';
            if (!text) return;
            mainBtn.disabled = true;
            fetch('/posts/' + postId + '/comment', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        comment: text
                    })
                })
                .then(function(r) {
                    return r.json();
                })
                .then(function(data) {
                    input.value = '';
                    prependComment(postId, data);
                    updateCommentCount(postId, 1);
                })
                .catch(function(err) {
                    console.error(err);
                })
                .finally(function() {
                    mainBtn.disabled = false;
                });
            return;
        }

        // Toggle reply box
        var replyToggle = e.target.closest('.reply-toggle-btn');
        if (replyToggle) {
            var commentId = replyToggle.dataset.comment;
            var box = document.getElementById('replyBox-' + commentId);
            if (!box) return;
            var hidden = box.style.display === 'none' || box.style.display === '';
            box.style.display = hidden ? 'flex' : 'none';
            if (hidden) {
                var inp = box.querySelector('input');
                if (inp) inp.focus();
            }
            return;
        }

        // Post reply
        var replyBtn = e.target.closest('.post-reply-btn');
        if (replyBtn) {
            var postId = replyBtn.dataset.post;
            var commentId = replyBtn.dataset.comment;
            var input = document.querySelector('.reply-input[data-comment="' + commentId + '"]');
            var text = input ? input.value.trim() : '';
            if (!text) return;
            replyBtn.disabled = true;
            fetch('/posts/' + postId + '/comment/' + commentId + '/reply', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        comment: text
                    })
                })
                .then(function(r) {
                    return r.json();
                })
                .then(function(data) {
                    input.value = '';
                    appendReply(commentId, data);
                    updateCommentCount(postId, 1);
                    var box = document.getElementById('replyBox-' + commentId);
                    if (box) box.style.display = 'none';
                })
                .catch(function(err) {
                    console.error(err);
                })
                .finally(function() {
                    replyBtn.disabled = false;
                });
            return;
        }
    });

    // ── COMMENTS LOADER ──
    function loadComments(postId) {
        var list = document.getElementById('commentsList-' + postId);
        if (!list) return;
        list.innerHTML = '<p class="text-muted text-center small py-3">Loading…</p>';
        fetch('/posts/' + postId + '/comments', {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(function(r) {
                return r.json();
            })
            .then(function(data) {
                list.innerHTML = '';
                if (!data.comments || !data.comments.length) {
                    list.innerHTML = '<p class="text-muted text-center small py-3">No comments yet. Be the first!</p>';
                    return;
                }
                data.comments.forEach(function(c) {
                    list.appendChild(buildCommentEl(postId, c));
                });
                var cnt = document.getElementById('answersCount-' + postId);
                if (cnt) cnt.textContent = data.comments_count;
            })
            .catch(function(err) {
                console.error('Load comments error:', err);
            });
    }

    function buildCommentEl(postId, comment) {
        var div = document.createElement('div');
        div.className = 'sl-answer-item';
        div.id = 'comment-' + comment.id;
        var av = comment.user.photo ? '<img src="' + comment.user.photo + '" alt="">' : comment.user.initial;
        var repliesHtml = '';
        if (comment.replies && comment.replies.length) comment.replies.forEach(function(r) {
            repliesHtml += buildReplyHtml(r);
        });
        div.innerHTML = '<div class="sl-a-avatar">' + av + '</div><div class="sl-a-body"><div class="sl-a-bubble"><h5>' + escHtml(comment.user.name) + '</h5><p>' + escHtml(comment.comment) + '</p></div><div class="sl-a-meta"><span>' + comment.created_at + '</span><button class="reply-toggle-btn" data-comment="' + comment.id + '">Reply</button></div><div id="replyBox-' + comment.id + '" style="display:none;gap:6px;padding:6px 0;align-items:center;"><input class="sl-reply-input reply-input" type="text" data-comment="' + comment.id + '" placeholder="Write a reply…" style="flex:1;"><button class="sl-btn sl-btn-primary post-reply-btn" data-post="' + postId + '" data-comment="' + comment.id + '" style="padding:4px 11px;font-size:12px;white-space:nowrap;">Reply</button></div><div class="sl-replies" id="replies-' + comment.id + '" style="display:block;">' + repliesHtml + '</div></div>';
        return div;
    }

    function buildReplyHtml(reply) {
        var av = reply.user.photo ? '<img src="' + reply.user.photo + '" alt="">' : reply.user.initial;
        return '<div class="sl-reply" id="reply-' + reply.id + '"><div class="sl-r-avatar">' + av + '</div><div class="sl-r-bubble"><h6>' + escHtml(reply.user.name) + '</h6><p>' + escHtml(reply.comment) + '</p><span style="font-size:11px;color:#999;">' + reply.created_at + '</span></div></div>';
    }

    function loadLikesModal(postId) {
        fetch('/posts/' + postId + '/likes').then(function(r) {
            return r.json();
        }).then(function(users) {
            var html = users.length ? '' : '<p class="text-muted text-center">No likes yet</p>';
            users.forEach(function(u) {
                html += '<div class="d-flex align-items-center gap-3 mb-3">';
                html += u.photo ? '<img src="' + u.photo + '" class="rounded-circle" width="38" height="38" style="object-fit:cover;">' : '<div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:38px;height:38px;"><i class="bi bi-person-fill text-secondary"></i></div>';
                html += '<div class="fw-semibold">' + escHtml(u.name) + '</div></div>';
            });
            var el = document.getElementById('likesList-' + postId);
            if (el) el.innerHTML = html;
        });
    }

    function prependComment(postId, comment) {
        var list = document.getElementById('commentsList-' + postId);
        if (!list) return;
        var empty = list.querySelector('p');
        if (empty) empty.remove();
        comment.replies = [];
        list.prepend(buildCommentEl(postId, comment));
    }

    function appendReply(commentId, reply) {
        var c = document.getElementById('replies-' + commentId);
        if (c) c.insertAdjacentHTML('beforeend', buildReplyHtml(reply));
    }

    function updateCommentCount(postId, delta) {
        var h = document.getElementById('answersCount-' + postId);
        if (h) h.textContent = parseInt(h.textContent || 0) + delta;
        var b = document.getElementById('commentCount-' + postId);
        if (b) b.textContent = '(' + (parseInt(b.textContent.replace(/\D/g, '') || 0) + delta) + ')';
    }

    function escHtml(str) {
        var d = document.createElement('div');
        d.appendChild(document.createTextNode(str || ''));
        return d.innerHTML;
    }

    // ── DAILY PUZZLE (refreshes every 24h) ──
    (function() {
        const STORAGE_KEY = 'smartlearn_daily_puzzle';
        const ONE_DAY = 24 * 60 * 60 * 1000;

        function isFresh(saved) {
            return saved && saved.ts && (Date.now() - saved.ts) < ONE_DAY;
        }

        function renderPuzzle(data) {
            const el = document.getElementById('puzzleContent');
            if (!el) return;

            if (data.type === 'trivia') {
                const allAnswers = [...data.incorrect, data.correct].sort(() => Math.random() - 0.5);
                el.innerHTML = `
                <div style="text-align:left">
                    <span class="badge mb-2" style="background:var(--blue-soft);color:var(--blue);font-size:11px;padding:3px 9px;border-radius:20px;font-weight:700">
                        ${data.category}
                    </span>
                    <p style="font-size:13.5px;font-weight:600;line-height:1.5;margin-bottom:12px">${data.question}</p>
                    <div id="triviaOptions" style="display:flex;flex-direction:column;gap:7px">
                        ${allAnswers.map((a, i) => `
                            <button type="button"
                                class="trivia-opt"
                                data-correct="${a === data.correct}"
                                style="background:#f5f7fa;border:1.5px solid #e5e7eb;border-radius:9px;padding:7px 12px;font-size:13px;font-weight:500;text-align:left;cursor:pointer;transition:all .2s;color:var(--text)">
                                <span style="font-weight:700;margin-right:6px;color:var(--blue)">${String.fromCharCode(65+i)}.</span>${a}
                            </button>`).join('')}
                    </div>
                    <div id="triviaResult" style="display:none;margin-top:10px;font-size:12.5px;font-weight:700;padding:7px 11px;border-radius:8px"></div>
                    <div style="margin-top:10px;display:flex;justify-content:space-between;align-items:center">
                        <small style="font-size:11px;color:var(--text-muted)">Refreshes in <span id="puzzleCountdown"></span></small>
                        <span class="badge" style="background:${data.difficulty==='easy'?'#d1fae5':data.difficulty==='medium'?'#fef3c7':'#fee2e2'};color:${data.difficulty==='easy'?'#065f46':data.difficulty==='medium'?'#92400e':'#991b1b'};font-size:10px;padding:2px 8px;border-radius:12px;font-weight:700;text-transform:capitalize">${data.difficulty}</span>
                    </div>
                </div>`;

                // Answer click handler
                document.querySelectorAll('.trivia-opt').forEach(btn => {
                    btn.addEventListener('click', function() {
                        if (document.getElementById('triviaResult').style.display !== 'none') return;
                        const isCorrect = this.dataset.correct === 'true';
                        document.querySelectorAll('.trivia-opt').forEach(b => {
                            b.disabled = true;
                            if (b.dataset.correct === 'true') {
                                b.style.background = '#d1fae5';
                                b.style.borderColor = '#22c55e';
                                b.style.color = '#065f46';
                            } else if (b === this && !isCorrect) {
                                b.style.background = '#fee2e2';
                                b.style.borderColor = '#ef4444';
                                b.style.color = '#991b1b';
                            }
                        });
                        const res = document.getElementById('triviaResult');
                        res.style.display = 'block';
                        res.style.background = isCorrect ? '#d1fae5' : '#fee2e2';
                        res.style.color = isCorrect ? '#065f46' : '#991b1b';
                        res.textContent = isCorrect ? '✓ Correct! Great job!' : `✗ The answer was: ${data.correct}`;
                    });
                });

            } else if (data.type === 'math') {
                el.innerHTML = `
                <div style="text-align:left">
                    <span class="badge mb-2" style="background:var(--blue-soft);color:var(--blue);font-size:11px;padding:3px 9px;border-radius:20px;font-weight:700">Math Challenge</span>
                    <p style="font-size:13.5px;font-weight:600;line-height:1.5;margin-bottom:10px">${data.question}</p>
                    <div style="display:flex;gap:7px;align-items:center">
                        <input type="number" id="mathAnswer" class="form-control" placeholder="Your answer…" style="font-size:13px;border-radius:9px;border:1.5px solid #e5e7eb;padding:6px 11px">
                        <button type="button" id="mathSubmit" class="btn btn-primary btn-sm" style="border-radius:9px;padding:6px 14px;font-size:13px;white-space:nowrap">Check</button>
                    </div>
                    <div id="mathResult" style="display:none;margin-top:9px;font-size:12.5px;font-weight:700;padding:7px 11px;border-radius:8px"></div>
                    <small style="display:block;margin-top:9px;font-size:11px;color:var(--text-muted)">Refreshes in <span id="puzzleCountdown"></span></small>
                </div>`;

                document.getElementById('mathSubmit').addEventListener('click', function() {
                    const val = parseInt(document.getElementById('mathAnswer').value);
                    const res = document.getElementById('mathResult');
                    res.style.display = 'block';
                    if (val === data.answer) {
                        res.style.background = '#d1fae5';
                        res.style.color = '#065f46';
                        res.textContent = '✓ Correct! Well done!';
                    } else {
                        res.style.background = '#fee2e2';
                        res.style.color = '#991b1b';
                        res.textContent = `✗ Not quite. The answer is ${data.answer}.`;
                    }
                    this.disabled = true;
                });
                document.getElementById('mathAnswer').addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') document.getElementById('mathSubmit').click();
                });
            }

            startCountdown();
        }

        function startCountdown() {
            const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');

            function tick() {
                const els = document.querySelectorAll('#puzzleCountdown');
                if (!els.length) return;
                const remaining = Math.max(0, ONE_DAY - (Date.now() - (saved.ts || Date.now())));
                const h = Math.floor(remaining / 3600000);
                const m = Math.floor((remaining % 3600000) / 60000);
                const s = Math.floor((remaining % 60000) / 1000);
                const text = `${h}h ${m}m ${s}s`;
                els.forEach(el => el.textContent = text);
            }
            tick();
            setInterval(tick, 1000);
        }

        function generateMathPuzzle(seed) {
            // Seeded deterministic puzzle so all users get same puzzle per day
            const rng = (n) => {
                let x = Math.sin(seed + n) * 10000;
                return Math.floor((x - Math.floor(x)) * n);
            };
            const types = ['add', 'mul', 'sub', 'perc', 'seq'];
            const t = types[rng(5)];
            if (t === 'add') {
                const a = rng(50) + 10,
                    b = rng(50) + 10;
                return {
                    type: 'math',
                    question: `What is ${a} + ${b}?`,
                    answer: a + b
                };
            } else if (t === 'mul') {
                const a = rng(12) + 2,
                    b = rng(12) + 2;
                return {
                    type: 'math',
                    question: `What is ${a} × ${b}?`,
                    answer: a * b
                };
            } else if (t === 'sub') {
                const b = rng(40) + 10,
                    a = b + rng(40) + 5;
                return {
                    type: 'math',
                    question: `What is ${a} − ${b}?`,
                    answer: a - b
                };
            } else if (t === 'perc') {
                const p = [10, 20, 25, 50][rng(4)],
                    n = (rng(8) + 1) * 10;
                return {
                    type: 'math',
                    question: `What is ${p}% of ${n}?`,
                    answer: Math.round(p * n / 100)
                };
            } else {
                const start = rng(8) + 2,
                    step = rng(5) + 2;
                const seq = [start, start + step, start + 2 * step, start + 3 * step];
                return {
                    type: 'math',
                    question: `Next number: ${seq.join(', ')}, __?`,
                    answer: start + 4 * step
                };
            }
        }

        async function loadPuzzle() {
            const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null');
            if (isFresh(saved)) {
                renderPuzzle(saved.data);
                return;
            }

            // Try Open Trivia DB (free, no key needed)
            try {
                const cats = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28]; // various knowledge cats
                const today = new Date();
                const seed = today.getFullYear() * 10000 + ((today.getMonth() + 1) * 100) + today.getDate();
                const cat = cats[seed % cats.length];
                const diff = ['easy', 'medium', 'hard'][seed % 3];
                const res = await fetch(`https://opentdb.com/api.php?amount=1&category=${cat}&difficulty=${diff}&type=multiple`);
                const json = await res.json();
                if (json.response_code === 0 && json.results.length) {
                    const q = json.results[0];
                    const decode = s => {
                        const t = document.createElement('textarea');
                        t.innerHTML = s;
                        return t.value;
                    };
                    const data = {
                        type: 'trivia',
                        category: decode(q.category),
                        difficulty: q.difficulty,
                        question: decode(q.question),
                        correct: decode(q.correct_answer),
                        incorrect: q.incorrect_answers.map(decode)
                    };
                    localStorage.setItem(STORAGE_KEY, JSON.stringify({
                        ts: Date.now(),
                        data
                    }));
                    renderPuzzle(data);
                    return;
                }
            } catch (e) {
                /* fallback */
            }

            // Fallback: local math puzzle
            const today = new Date();
            const seed = today.getFullYear() * 10000 + ((today.getMonth() + 1) * 100) + today.getDate();
            const data = generateMathPuzzle(seed);
            localStorage.setItem(STORAGE_KEY, JSON.stringify({
                ts: Date.now(),
                data
            }));
            renderPuzzle(data);
        }

        loadPuzzle();
    })();
    // ── DYNAMIC NEWS (refreshes every 24h) ──
    (function() {
        const NEWS_KEY = 'smartlearn_news_feed_v3';
        const ONE_DAY = 24 * 60 * 60 * 1000;

        function isFresh(saved) {
            return saved && saved.ts && (Date.now() - saved.ts) < ONE_DAY;
        }

        function renderNews(articles) {
            const ul = document.getElementById('newsFeed');
            if (!ul) return;
            ul.innerHTML = articles.map(a => `
            <li class="mb-2">
                <a href="${a.url}" target="_blank" rel="noopener" class="news-link"
                   style="font-size:13px;display:block;line-height:1.4;">
                   &#8226; ${a.title}
                </a>
            </li>`).join('');
        }

        function startNewsCountdown(ts) {
            function tick() {
                const el = document.getElementById('newsCountdown');
                if (!el) return;
                const remaining = Math.max(0, ONE_DAY - (Date.now() - ts));
                const h = Math.floor(remaining / 3600000);
                const m = Math.floor((remaining % 3600000) / 60000);
                el.textContent = `${h}h ${m}m`;
            }
            tick();
            setInterval(tick, 60000);
        }

        // Fallback static articles (used if API fails)
       function getFallbackNews() {
    return [
        { title: 'AI-Powered Creative Co-Pilots in 2026', url: 'https://techcrunch.com' },
        { title: 'Hyper-Personalization Becomes Standard', url: 'https://wired.com' },
        { title: 'Gamification 2.0: Emotional Design', url: 'https://edutopia.org' },
        { title: 'Collaborative In-Flow Learning', url: 'https://elearningindustry.com' },
        { title: 'Emerging Risks & AI Regulations', url: 'https://theverge.com' },
        { title: 'Microlearning Trends Reshaping EdTech', url: 'https://elearningindustry.com' },
        { title: 'Adaptive Learning Platforms of 2026', url: 'https://techcrunch.com' },
        { title: 'Social Learning & Peer Collaboration', url: 'https://edutopia.org' },
    ];
}

        async function loadNews() {
            const saved = JSON.parse(localStorage.getItem(NEWS_KEY) || 'null');
            if (isFresh(saved)) {
                renderNews(saved.articles);
                startNewsCountdown(saved.ts);
                return;
            }

            // Try GNews API (free tier: 100 req/day, no key needed for basic)
            // Using RSS-to-JSON proxy for ed-tech news (no API key required)
            try {
               const rssUrl = encodeURIComponent('https://feeds.feedburner.com/edutopia/RssFeed');
const res = await fetch(`https://api.rss2json.com/v1/api.json?rss_url=${rssUrl}&count=8&api_key=`);
                const json = await res.json();

                if (json.status === 'ok' && json.items && json.items.length) {
                    const articles = json.items.slice(0, 8).map(item => ({
                        title: item.title.length > 55 ? item.title.substring(0, 55) + '…' : item.title,
                        url: item.link
                    }));
                    const payload = {
                        ts: Date.now(),
                        articles
                    };
                    localStorage.setItem(NEWS_KEY, JSON.stringify(payload));
                    renderNews(articles);
                    startNewsCountdown(payload.ts);
                    return;
                }
            } catch (e) {
                /* fallback */
            }

            // Try a second source: DEV.to tech articles
            try {
               const res = await fetch('https://dev.to/api/articles?tag=education&per_page=8&top=7');
                const json = await res.json();
                if (json && json.length) {
                    const articles = json.slice(0, 8).map(item => ({
                        title: item.title.length > 55 ? item.title.substring(0, 55) + '…' : item.title,
                        url: item.url
                    }));
                    const payload = {
                        ts: Date.now(),
                        articles
                    };
                    localStorage.setItem(NEWS_KEY, JSON.stringify(payload));
                    renderNews(articles);
                    startNewsCountdown(payload.ts);
                    return;
                }
            } catch (e) {
                /* fallback */
            }

            // Final fallback: static articles
            const payload = {
                ts: Date.now(),
                articles: getFallbackNews()
            };
            localStorage.setItem(NEWS_KEY, JSON.stringify(payload));
            renderNews(payload.articles);
            startNewsCountdown(payload.ts);
        }

        loadNews();
    })();
</script>
@endsection