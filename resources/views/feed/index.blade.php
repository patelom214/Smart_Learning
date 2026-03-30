@extends('layouts.app')

@section('title', 'Discover')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        --card-shadow-hover: 0 4px 16px rgba(0, 0, 0, 0.12);
        --cl-bg: #f3f2ef;
        --cl-surface: #ffffff;
        --cl-border: #e4e6ea;
        --cl-primary: #667eea;
        --cl-primary-d: #5568d4;
        --cl-accent: #e7440d;
        --cl-text: #050505;
        --cl-text-sec: #65676b;
        --cl-tag-bg: #eef0ff;
        --cl-tag-text: #667eea;
        --cl-ans-bg: #f0fdf4;
        --cl-ans-bdr: #22c55e;
        --cl-radius: 14px;
    }

    .feed-container {
        background: var(--cl-bg);
        min-height: 100vh;
    }

    /* LEFT SIDEBAR */
    .profile-card {
        border-radius: 16px;
        border: none;
        box-shadow: var(--card-shadow);
        background: white;
        transition: all .3s;
    }

    .profile-card:hover {
        box-shadow: var(--card-shadow-hover);
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 3px solid #667eea;
        transition: transform .3s;
    }

    .profile-avatar:hover {
        transform: scale(1.05);
    }

    .sidebar-link {
        padding: .5rem 1rem;
        border-radius: 8px;
        transition: all .2s;
        font-weight: 500;
    }

    .sidebar-link:hover {
        background: #f3f2ef;
        color: #667eea !important;
        transform: translateX(5px);
    }

    /* RIGHT SIDEBAR */
    .news-card {
        border-radius: 16px;
        border: none;
        box-shadow: var(--card-shadow);
        background: white;
    }

    .news-link {
        padding: .5rem 0;
        transition: all .2s;
        display: block;
        color: #333;
        font-weight: 500;
        text-decoration: none;
    }

    .news-link:hover {
        color: #667eea;
        padding-left: .5rem;
    }

    .sticky-sidebar {
        position: sticky;
        top: 80px;
    }

    @media(max-width:768px) {
        .sticky-sidebar {
            position: relative;
            top: 0;
        }
    }

    /* POST CARDS */
    .post-card {
        border-radius: 16px;
        border: none;
        box-shadow: var(--card-shadow);
        background: white;
        margin-bottom: 1rem;
        transition: all .3s;
    }

    .post-card:hover {
        box-shadow: var(--card-shadow-hover);
    }

    .post-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .post-media-wrapper {
        background: #f8f9fa;
        border-top: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
    }

    .action-btn {
        border: none;
        background: transparent;
        padding: .6rem 1rem;
        border-radius: 8px;
        transition: all .2s;
        font-weight: 500;
        color: #666;
        cursor: pointer;
    }

    .action-btn:hover {
        background: #f3f2ef;
        color: #667eea;
    }

    .action-btn i {
        font-size: 1.1rem;
        margin-right: .25rem;
    }

    .like-btn i {
        color: #6c757d;
        transition: all .3s;
    }

    .like-btn.liked i {
        color: #667eea;
        transform: scale(1.2);
    }

    .modal-content {
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, .15);
    }

    /* COMPOSER SHELL */
    .sl-composer {
        background: var(--cl-surface);
        border-radius: var(--cl-radius);
        box-shadow: var(--card-shadow);
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .sl-tabs {
        display: flex;
        gap: 4px;
        padding: 12px 14px 0;
        border-bottom: 1px solid var(--cl-border);
    }

    .sl-tab {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 700;
        font-family: inherit;
        background: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        border-radius: 8px 8px 0 0;
        color: var(--cl-text-sec);
        cursor: pointer;
        transition: all .2s;
        margin-bottom: -1px;
    }

    .sl-tab:hover {
        color: var(--cl-primary);
        background: var(--cl-tag-bg);
    }

    .sl-tab.active {
        color: var(--cl-primary);
        border-bottom-color: var(--cl-primary);
        background: var(--cl-tag-bg);
    }

    .sl-tab svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
    }

    .sl-panel {
        display: none;
        padding: 16px;
    }

    .sl-panel.active {
        display: block;
        animation: slFadeIn .2s ease;
    }

    @keyframes slFadeIn {
        from {
            opacity: 0;
            transform: translateY(5px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    /* USER ROW */
    .sl-user-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }

    .sl-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
        font-size: 15px;
        overflow: hidden;
        background: var(--primary-gradient);
    }

    .sl-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sl-user-info h5 {
        font-size: 14px;
        font-weight: 700;
        margin: 0 0 2px;
    }

    .sl-audience {
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        color: var(--cl-primary);
        background: var(--cl-tag-bg);
        border: none;
        border-radius: 20px;
        padding: 3px 10px;
        cursor: pointer;
    }

    /* IMAGE PANEL */
    .sl-caption {
        width: 100%;
        border: none;
        resize: none;
        font-family: inherit;
        font-size: 15px;
        color: var(--cl-text);
        min-height: 68px;
        outline: none;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .sl-caption::placeholder {
        color: #bcc0c4;
    }

    .sl-emoji-row {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 12px;
    }

    .sl-emoji-row button {
        background: none;
        border: 1.5px solid var(--cl-border);
        border-radius: 7px;
        padding: 4px 7px;
        font-size: 15px;
        cursor: pointer;
        transition: all .15s;
        line-height: 1;
    }

    .sl-emoji-row button:hover {
        background: var(--cl-tag-bg);
        border-color: var(--cl-primary);
        transform: scale(1.15);
    }

    .sl-drop-zone {
        border: 2px dashed var(--cl-border);
        border-radius: 10px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        background: #fafafa;
        transition: all .2s;
        margin-bottom: 14px;
    }

    .sl-drop-zone:hover {
        border-color: var(--cl-primary);
        background: var(--cl-tag-bg);
    }

    .sl-drop-zone svg {
        width: 30px;
        height: 30px;
        color: var(--cl-text-sec);
    }

    .sl-drop-zone span {
        font-size: 13px;
        font-weight: 700;
        color: var(--cl-text-sec);
    }

    .sl-drop-zone small {
        font-size: 11px;
        color: #bcc0c4;
    }

    .sl-media-preview {
        display: none;
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 14px;
    }

    .sl-media-preview img {
        width: 100%;
        display: block;
        max-height: 300px;
        object-fit: cover;
    }

    .sl-remove-media {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0, 0, 0, .55);
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        color: #fff;
        font-size: 13px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sl-friends-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--cl-text-sec);
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 8px;
        display: block;
    }

    .sl-send-all-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 9px 13px;
        background: #fafafa;
        border-radius: 8px;
        margin-bottom: 10px;
        border: 1.5px solid var(--cl-border);
    }

    .sl-send-all-row span {
        font-size: 13px;
        font-weight: 600;
    }

    .sl-toggle {
        position: relative;
        display: inline-block;
        width: 42px;
        height: 23px;
    }

    .sl-toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .sl-slider {
        position: absolute;
        inset: 0;
        background: #ccd0d5;
        border-radius: 23px;
        cursor: pointer;
        transition: .3s;
    }

    .sl-slider::before {
        content: '';
        position: absolute;
        height: 17px;
        width: 17px;
        left: 3px;
        bottom: 3px;
        background: #fff;
        border-radius: 50%;
        transition: .3s;
    }

    .sl-toggle input:checked+.sl-slider {
        background: var(--cl-primary);
    }

    .sl-toggle input:checked+.sl-slider::before {
        transform: translateX(19px);
    }

    .sl-friends-list {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 14px;
    }

    .sl-friend-chip {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #fafafa;
        border: 1.5px solid var(--cl-border);
        border-radius: 20px;
        padding: 5px 12px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        color: var(--cl-text-sec);
        transition: all .2s;
        user-select: none;
    }

    .sl-friend-chip input {
        display: none;
    }

    .sl-friend-chip.selected {
        background: var(--cl-tag-bg);
        border-color: var(--cl-primary);
        color: var(--cl-primary);
    }

    .sl-friend-chip .fc-av {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        background: var(--primary-gradient);
    }

    /* QUESTION STEPS */
    .sl-steps {
        display: flex;
        align-items: center;
        margin-bottom: 18px;
    }

    .sl-step {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        font-weight: 700;
        color: var(--cl-text-sec);
    }

    .sl-step.active .sl-step-num {
        background: var(--cl-primary);
        color: #fff;
    }

    .sl-step.done .sl-step-num {
        background: var(--cl-ans-bdr);
        color: #fff;
    }

    .sl-step-num {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: var(--cl-border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
        transition: background .3s;
    }

    .sl-step-line {
        flex: 1;
        height: 2px;
        background: var(--cl-border);
        margin: 0 8px;
    }

    .sl-step-line.done {
        background: var(--cl-ans-bdr);
    }

    /* FORM ELEMENTS */
    .sl-form-group {
        margin-bottom: 14px;
    }

    .sl-form-group>label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px;
        color: var(--cl-text);
    }

    .sl-hint {
        font-size: 11px;
        color: var(--cl-text-sec);
        margin-bottom: 5px;
    }

    .sl-input {
        width: 100%;
        border: 1.5px solid var(--cl-border);
        border-radius: 8px;
        padding: 9px 13px;
        font-family: inherit;
        font-size: 14px;
        color: var(--cl-text);
        outline: none;
        transition: border-color .2s;
        background: var(--cl-surface);
    }

    .sl-input:focus {
        border-color: var(--cl-primary);
    }

    .sl-rt-bar {
        display: flex;
        gap: 2px;
        padding: 6px 8px;
        background: #fafafa;
        border: 1.5px solid var(--cl-border);
        border-bottom: none;
        border-radius: 8px 8px 0 0;
    }

    .sl-rt-btn {
        width: 28px;
        height: 28px;
        border: none;
        background: transparent;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--cl-text-sec);
        font-size: 13px;
        font-weight: 700;
        transition: background .15s;
    }

    .sl-rt-btn:hover {
        background: var(--cl-border);
    }

    .sl-rt-area {
        border: 1.5px solid var(--cl-border);
        border-top: none;
        border-radius: 0 0 8px 8px;
        padding: 10px 13px;
        min-height: 100px;
        outline: none;
        font-family: inherit;
        font-size: 14px;
        line-height: 1.6;
    }

    .sl-rt-area:focus {
        border-color: var(--cl-primary);
    }

    .sl-type-opts {
        display: flex;
        gap: 8px;
        margin-top: 6px;
    }

    .sl-type-opt {
        flex: 1;
        padding: 10px 8px;
        border: 1.5px solid var(--cl-border);
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        transition: all .2s;
        font-size: 12px;
        font-weight: 700;
        color: var(--cl-text-sec);
        background: var(--cl-surface);
        font-family: inherit;
        text-align: center;
    }

    .sl-type-opt svg {
        width: 20px;
        height: 20px;
    }

    .sl-type-opt.selected {
        border-color: var(--cl-primary);
        background: var(--cl-tag-bg);
        color: var(--cl-primary);
    }

    .sl-tags-wrap {
        border: 1.5px solid var(--cl-border);
        border-radius: 8px;
        padding: 6px 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        cursor: text;
        transition: border-color .2s;
        min-height: 42px;
    }

    .sl-tags-wrap:focus-within {
        border-color: var(--cl-primary);
    }

    .sl-tag-pill {
        display: flex;
        align-items: center;
        gap: 4px;
        background: var(--cl-tag-bg);
        color: var(--cl-tag-text);
        border-radius: 6px;
        padding: 3px 8px;
        font-size: 12px;
        font-weight: 700;
    }

    .sl-tag-pill button {
        background: none;
        border: none;
        color: var(--cl-tag-text);
        cursor: pointer;
        font-size: 12px;
        padding: 0;
        line-height: 1;
    }

    .sl-tag-input {
        border: none;
        outline: none;
        font-family: inherit;
        font-size: 13px;
        flex: 1;
        min-width: 90px;
        padding: 3px 0;
        background: transparent;
    }

    .sl-visibility-row {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 13px;
        background: #fafafa;
        border-radius: 8px;
        border: 1.5px solid var(--cl-border);
        font-size: 13px;
        font-weight: 600;
    }

    .sl-visibility-row select {
        border: none;
        background: transparent;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        color: var(--cl-primary);
        cursor: pointer;
        outline: none;
    }

    .sl-edit-notice {
        display: flex;
        gap: 10px;
        padding: 10px 13px;
        background: #fff8e1;
        border-left: 3px solid #f59e0b;
        border-radius: 6px;
        margin-bottom: 14px;
        font-size: 12px;
        color: #92400e;
        line-height: 1.5;
    }

    .sl-edit-notice svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        color: #f59e0b;
        margin-top: 1px;
    }

    .sl-action-bar {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 6px;
    }

    .sl-btn {
        padding: 8px 18px;
        border-radius: 8px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        border: none;
        transition: all .2s;
    }

    .sl-btn-ghost {
        background: #f0f2f5;
        color: var(--cl-text-sec);
    }

    .sl-btn-ghost:hover {
        background: #e4e6ea;
    }

    .sl-btn-primary {
        background: var(--cl-primary);
        color: #fff;
    }

    .sl-btn-primary:hover {
        background: var(--cl-primary-d);
    }

    .sl-btn-primary:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    .sl-char {
        text-align: right;
        font-size: 11px;
        color: var(--cl-text-sec);
        margin-top: 3px;
    }

    /* Q&A FEED */
    .sl-q-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 3px 10px;
        border-radius: 20px;
        margin-bottom: 8px;
    }

    .sl-q-badge svg {
        width: 12px;
        height: 12px;
    }

    .sl-q-badge.troubleshoot {
        background: #fff0ea;
        color: #e7440d;
    }

    .sl-q-badge.design {
        background: #f0e7ff;
        color: #7c3aed;
    }

    .sl-q-badge.general {
        background: #e7f3ff;
        color: #1877f2;
    }

    .sl-q-title {
        font-size: 16px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 8px;
        color: var(--cl-text);
    }

    .sl-q-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 8px;
    }

    .sl-q-tag {
        font-size: 12px;
        font-weight: 700;
        background: var(--cl-tag-bg);
        color: var(--cl-tag-text);
        padding: 2px 9px;
        border-radius: 6px;
    }

    /* ANSWERS SECTION */
    .sl-answers {
        border-top: 1px solid var(--cl-border);
        display: none;
    }

    .sl-answers-hdr {
        padding: 10px 16px 6px;
        font-size: 13px;
        font-weight: 700;
        color: var(--cl-text-sec);
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .sl-answers-hdr span {
        background: var(--cl-primary);
        color: #fff;
        font-size: 11px;
        border-radius: 10px;
        padding: 1px 7px;
    }

    .sl-answer-item {
        padding: 10px 16px;
        border-top: 1px solid var(--cl-border);
        display: flex;
        gap: 10px;
    }

    .sl-a-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
        font-size: 12px;
        overflow: hidden;
        background: var(--primary-gradient);
    }

    .sl-a-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sl-a-body {
        flex: 1;
        min-width: 0;
    }

    .sl-a-bubble {
        background: #f3f2ef;
        border-radius: 12px;
        padding: 9px 13px;
        margin-bottom: 4px;
    }

    .sl-a-bubble h5 {
        font-size: 13px;
        font-weight: 700;
        margin: 0 0 3px;
    }

    .sl-a-bubble p {
        font-size: 13px;
        line-height: 1.6;
        color: #333;
        margin: 0;
    }

    .sl-a-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 12px;
        color: var(--cl-text-sec);
    }

    .sl-a-meta button {
        background: none;
        border: none;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        color: var(--cl-text-sec);
        cursor: pointer;
        padding: 0;
    }

    .sl-a-meta button:hover {
        color: var(--cl-primary);
    }

    .sl-accepted-badge {
        color: var(--cl-ans-bdr);
        font-weight: 700;
    }

    .sl-answer-item.accepted .sl-a-bubble {
        background: var(--cl-ans-bg);
        border: 1.5px solid var(--cl-ans-bdr);
    }

    .sl-replies {
        margin-top: 7px;
        padding-left: 14px;
        border-left: 2px solid var(--cl-border);
        display: none;
    }

    .sl-reply {
        display: flex;
        gap: 7px;
        margin-top: 8px;
    }

    .sl-r-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
        font-size: 9px;
        overflow: hidden;
        background: var(--primary-gradient);
    }

    .sl-r-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sl-r-bubble {
        background: #f3f2ef;
        border-radius: 9px;
        padding: 7px 11px;
        flex: 1;
    }

    .sl-r-bubble h6 {
        font-size: 12px;
        font-weight: 700;
        margin: 0 0 2px;
    }

    .sl-r-bubble p {
        font-size: 12px;
        line-height: 1.5;
        color: #444;
        margin: 0;
    }

    .sl-reply-compose {
        display: flex;
        gap: 6px;
        margin-top: 7px;
        align-items: center;
    }

    .sl-reply-input {
        flex: 1;
        border: 1.5px solid var(--cl-border);
        border-radius: 20px;
        padding: 5px 12px;
        font-family: inherit;
        font-size: 12px;
        outline: none;
        transition: border-color .2s;
    }

    .sl-reply-input:focus {
        border-color: var(--cl-primary);
    }

    .sl-ans-composer {
        padding: 10px 16px;
        display: flex;
        gap: 10px;
        border-top: 1px solid var(--cl-border);
        align-items: flex-start;
    }

    .sl-ans-input {
        width: 100%;
        border: 1.5px solid var(--cl-border);
        border-radius: 22px;
        padding: 9px 16px;
        font-family: inherit;
        font-size: 13px;
        color: var(--cl-text);
        outline: none;
        transition: all .3s;
        resize: none;
        line-height: 1.5;
    }

    .sl-ans-input:focus {
        border-color: var(--cl-primary);
        border-radius: 12px;
        min-height: 72px;
    }

    .sl-ans-input::placeholder {
        color: #bcc0c4;
    }

    .sl-ans-actions {
        display: none;
        justify-content: space-between;
        align-items: center;
        margin-top: 8px;
    }

    .sl-ans-emojis {
        display: flex;
        gap: 4px;
    }

    .sl-ans-emojis button {
        background: none;
        border: none;
        font-size: 15px;
        cursor: pointer;
        padding: 2px;
        border-radius: 4px;
        transition: transform .15s;
    }

    .sl-ans-emojis button:hover {
        transform: scale(1.25);
    }
</style>

<div class="feed-container">
    <div class="container py-4">
        <div class="row">

            {{-- ══ LEFT SIDEBAR (UNCHANGED) ══ --}}
            <div class="col-md-3 d-none d-md-block">
                <div class="sticky-sidebar">
                    <div class="profile-card mb-3">
                        <div class="card-body text-center">
                            @if(auth()->user()->profile_photo)
                            <img src="{{ Auth::user()->profile_photo 
                                ? Auth::user()->profile_photo 
                                : asset('images/default.png') }}"
                                class="rounded-circle"
                                width="36"
                                height="36"
                                style="object-fit: cover;">
                            @else
                            <div class="rounded-circle profile-avatar d-flex align-items-center justify-content-center mx-auto mb-3 bg-light">
                                <i class="bi bi-person-fill fs-2 text-secondary"></i>
                            </div>
                            @endif
                            <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                            <p class="text-muted small mb-3">{{ auth()->user()->bio ?? 'No bio yet' }}</p>
                            <hr class="my-3">
                            <a href="{{ route('posts.my') }}" class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-2"><i class="bi bi-file-earmark-post"></i> My Posts</a>
                            <a href="{{ url('/friends') }}" class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-2"><i class="bi bi-people-fill"></i> Friends</a>
                            <a href="{{ url('/skills') }}" class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-2"><i class="bi bi-lightbulb-fill"></i> My Skills</a>
                            <a href="{{ url('/roadmaps') }}" class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2"><i class="bi bi-map-fill"></i> Learning Roadmap</a>
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
                                        <button type="button" class="sl-type-opt selected" data-type="troubleshoot">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="12" y1="8" x2="12" y2="12" />
                                                <line x1="12" y1="16" x2="12.01" y2="16" />
                                            </svg>
                                            Troubleshooting
                                        </button>
                                        <button type="button" class="sl-type-opt" data-type="design">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                            </svg>
                                            Design Advice
                                        </button>
                                        <button type="button" class="sl-type-opt" data-type="general">
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
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                                @csrf
                                @method('PUT')
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
                                    <img src="{{ asset('storage/' . $post->media) }}" class="img-fluid rounded-3" style="max-height:200px;">
                                </div>
                                @endif
                                <div class="mb-2 text-center d-none" id="editNewImgBox-{{ $post->id }}">
                                    <img src="" class="img-fluid rounded-3" style="max-height:200px;" id="editNewImg-{{ $post->id }}">
                                </div>
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
                                    <input type="hidden"
                                        name="tags"
                                        id="editTagsHidden-{{ $post->id }}"
                                        value="{{ $post->tags }}">
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
                <div class="card mb-3 p-3">
                    <form method="GET" action="{{ route('feed') }}" id="filterForm"
                        style="display:flex;gap:10px;align-items:center;">

                        {{-- Search Input --}}
                        <input type="text"
                            name="search"
                            id="searchInput"
                            value="{{ request('search') }}"
                            placeholder="Search posts..."
                            class="form-control">

                        {{-- Tag Dropdown --}}
                        <select name="tag"
                            id="tagFilter"
                            class="form-select"
                            style="max-width:200px;">
                            <option value="">Filter by Tag</option>
                            @foreach($allTags as $tag)
                            <option value="{{ $tag }}"
                                {{ request('tag') == $tag ? 'selected' : '' }}>
                                {{ $tag }}
                            </option>
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
                                <img src="{{ $post->user->profile_photo 
                         ? $post->user->profile_photo 
                         : asset('images/default.png') }}" width="48" height="48" class="rounded-circle border object-fit-cover">
                                @else
                                <div class="d-flex align-items-center justify-content-center rounded-circle border bg-light" style="width:48px;height:48px;">
                                    <i class="bi bi-person-fill fs-5 text-secondary"></i>
                                </div>
                                @endif
                                <div>

                                    <h4 class="fw-bold">{{ $post->title }}</h4>
                                    <small class="text-muted">
                                        <i class="bi bi-clock"></i> Posted by {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                                        @if(!empty($post->post_type) && $post->post_type === 'question')
                                        &nbsp;<span class="badge bg-light text-secondary border">Question</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                            @if(auth()->id() === $post->user_id || auth()->user()->role === 'admin')
                            <div class="dropdown">
                                <button class="btn btn-light rounded-circle p-2" data-bs-toggle="dropdown" type="button">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                    <li>
                                        <button type="button" class="dropdown-item open-edit-tab-btn" data-post="{{ $post->id }}">
                                            <i class="bi bi-pencil me-2"></i>Edit
                                        </button>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                            @csrf @method('DELETE')
                                            <button class="dropdown-item text-danger" type="submit">
                                                <i class="bi bi-trash me-2"></i>Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body px-4 py-3">
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
                        <p class="card-text mb-0">{!! $post->content !!}</p>
                        @if(!empty($post->tags))
                        <div class="sl-q-tags mt-2">
                            @foreach(explode(',', $post->tags) as $tag)
                            <span class="sl-q-tag">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    @if($post->media)
                    <div class="post-media-wrapper" style="width:100%;height:420px;display:flex;align-items:center;justify-content:center;">
                        <img src="{{ asset('storage/' . $post->media) }}" style="width:100%;height:100%;object-fit:cover;object-position:center;" alt="Post media">
                    </div>
                    @endif

                    {{-- ── CARD FOOTER: LIKE / COMMENT / SHARE ── --}}
                    <div class="card-footer bg-white border-0 py-2 px-3">
                        <div class="d-flex justify-content-around">

                            {{-- Like --}}
                            <button type="button"
                                class="action-btn like-btn {{ $post->likes->where('user_id', auth()->id())->count() ? 'liked' : '' }}"
                                data-post="{{ $post->id }}">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                <span class="like-count">{{ $post->likes_count }}</span>
                            </button>

                            {{-- Comment toggle --}}
                            <button type="button"
                                class="action-btn toggle-answers-btn"
                                data-post="{{ $post->id }}"
                                data-target="answers-{{ $post->id }}">
                                <i class="bi bi-chat-fill"></i>
                                {{ (!empty($post->post_type) && $post->post_type === 'question') ? 'Answer' : 'Comment' }}
                                <span class="ms-1 text-muted small" id="commentCount-{{ $post->id }}">
                                    ({{ $post->comments_count }})
                                </span>
                            </button>

                            {{-- Share --}}
                            <button type="button" class="action-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#shareModal-{{ $post->id }}">
                                <i class="bi bi-share-fill"></i> Share
                            </button>

                        </div>

                        {{-- Liked by text --}}
                        @php
                        $likeCount = $post->likes_count;
                        $likedUsers = $post->likes->take(2);
                        $remainingLikes = $likeCount - 2;
                        @endphp
                        @if($likeCount > 0)
                        <div class="px-3 pb-2 small text-muted" id="likeText-{{ $post->id }}">
                            Liked by
                            @foreach($likedUsers as $like)
                            {{ $like->user->name }}@if(!$loop->last), @endif
                            @endforeach
                            @if($remainingLikes > 0)
                            and <a href="#" class="text-dark fw-semibold text-decoration-none show-likes"
                                data-post="{{ $post->id }}"
                                data-bs-toggle="modal"
                                data-bs-target="#likesModal-{{ $post->id }}">
                                {{ $remainingLikes }} others
                            </a>
                            @endif
                        </div>
                        @endif
                    </div>

                    {{-- ── COMMENTS PANEL ── --}}
                    <div class="sl-answers" id="answers-{{ $post->id }}" style="display:none;">

                        {{-- Header --}}
                        <div class="sl-answers-hdr">
                            {{ (!empty($post->post_type) && $post->post_type === 'question') ? 'Answers' : 'Comments' }}
                            <span id="answersCount-{{ $post->id }}">{{ $post->comments_count }}</span>
                        </div>

                        {{-- Dynamic list (filled by JS) --}}
                        <div id="commentsList-{{ $post->id }}"></div>

                        {{-- New comment composer --}}
                        <div style="display:flex; gap:8px; align-items:center; padding:10px 16px; border-top:1px solid #e4e6ea;">
                            <div class="sl-a-avatar">
                                @if(auth()->user()->profile_photo)
                                <img src="{{ Auth::user()->profile_photo 
                         ? Auth::user()->profile_photo 
                         : asset('images/default.png') }}" alt="">
                                @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                @endif
                            </div>
                            <input class="sl-reply-input main-comment-input"
                                type="text"
                                data-post="{{ $post->id }}"
                                placeholder="Write a {{ (!empty($post->post_type) && $post->post_type === 'question') ? 'answer' : 'comment' }}…"
                                style="flex:1;">
                            <button class="sl-btn sl-btn-primary main-comment-btn"
                                data-post="{{ $post->id }}"
                                style="padding:5px 14px; font-size:13px; white-space:nowrap;">
                                Post
                            </button>
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
                                            @if($friend->profile_photo)
                                            <img src="{{ asset('storage/' . $friend->profile_photo) }}" width="36" height="36" class="rounded-circle me-2">
                                            @endif
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
                                        <img src="{{ asset('storage/' . $like->user->profile_photo) }}" width="40" height="40" class="rounded-circle">
                                        @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                            <i class="bi bi-person-fill text-secondary"></i>
                                        </div>
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
                        <p class="text-muted">Follow friends to see their posts here, or create your first post!</p>
                        @if(request('search'))
                        <p>No results found for "<strong>{{ request('search') }}</strong>"</p>
                        @endif

                        @if(request('tag'))
                        <p>No posts found under tag "<strong>#{{ request('tag') }}</strong>"</p>
                        @endif
                    </div>
                </div>
                @endforelse

                <div class="mt-3">{{ $posts->links() }}</div>

            </div>{{-- /col center --}}

            {{-- ══ RIGHT SIDEBAR (UNCHANGED) ══ --}}
            <div class="col-md-3 d-none d-lg-block">
                <div class="sticky-sidebar">
                    <div class="news-card mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3"><i class="bi bi-newspaper me-2"></i>Smart Learners News</h6>
                            <ul class="list-unstyled small mb-0">
                                <li class="mb-2"><a href="#" class="news-link">&#8226; AI-Powered Creative Co-Pilots</a></li>
                                <li class="mb-2"><a href="#" class="news-link">&#8226; Hyper-Personalization Standard</a></li>
                                <li class="mb-2"><a href="#" class="news-link">&#8226; Gamification 2.0: Emotional Design</a></li>
                                <li class="mb-2"><a href="#" class="news-link">&#8226; Collaborative In-Flow Learning</a></li>
                                <li><a href="#" class="news-link">&#8226; Emerging Risks &amp; Regulations</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="news-card mb-3">
                        <div class="card-body text-center">
                            <h6 class="fw-bold mb-3"><i class="bi bi-puzzle-fill me-2"></i>Today's Puzzle</h6>
                            <img src="{{ asset('images/Sliding Puzzle.gif') }}" alt="Puzzle" class="img-fluid rounded-3 shadow-sm" style="max-height:180px;object-fit:contain;">
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body text-center small">
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

        </div>{{-- /row --}}
    </div>{{-- /container --}}
</div>{{-- /feed-container --}}
<input type="hidden" id="sessionFormType" value="{{ session('form_type') }}">
<input type="hidden" id="sessionEditId" value="{{ session('edit_post_id') }}">
{{-- ══════════════════════════════════════
     ALL JAVASCRIPT — ZERO INLINE HANDLERS
══════════════════════════════════════ --}}
<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    document.addEventListener('DOMContentLoaded', function() {

        /* ── 1. COMPOSER TABS ── */
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

        /* ── 2. QUESTION WIZARD ── */
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

        /* Rich text toolbar – question */
        var qRtBar = document.getElementById('qRtBar');
        if (qRtBar) {
            qRtBar.addEventListener('click', function(e) {
                var btn = e.target.closest('.sl-rt-btn');
                if (!btn) return;
                e.preventDefault();
                document.execCommand(btn.dataset.cmd, false, btn.dataset.val || null);
            });
        }

        /* Question type options */
        document.querySelectorAll('.sl-type-opt').forEach(function(opt) {
            opt.addEventListener('click', function() {
                document.querySelectorAll('.sl-type-opt').forEach(function(o) {
                    o.classList.remove('selected');
                });
                this.classList.add('selected');
                var th = document.getElementById('qTypeHidden');
                if (th) th.value = this.dataset.type;
            });
        });

        /* Question tag input */
        var qTagIn = document.getElementById('qTagIn');
        if (qTagIn) {
            qTagIn.addEventListener('keydown', function(e) {
                addTagToWrap(e, 'qTagsWrap', 'qTagsHidden');
            });
        }

        /* Question form submit */
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

        /* ── 3. EDIT PANEL ── */
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

        /* Rich text toolbars – edit forms */
        document.querySelectorAll('.sl-edit-form .sl-rt-bar').forEach(function(bar) {
            bar.addEventListener('click', function(e) {
                var btn = e.target.closest('.sl-rt-btn');
                if (!btn) return;
                e.preventDefault();
                document.execCommand(btn.dataset.cmd, false, btn.dataset.val || null);
            });
        });

        /* Edit form tag inputs */
        document.querySelectorAll('.edit-tag-input').forEach(function(inp) {
            inp.addEventListener('keydown', function(e) {
                addTagToWrap(e, inp.dataset.wrap, inp.dataset.hidden);
            });
        });

        /* Edit form image preview */
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

        /* Edit save – sync body & tags before submit */
        document.querySelectorAll('.edit-save-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var postId = this.dataset.post;
                var body = document.getElementById('editBody-' + postId);
                var hidden = document.getElementById('editBodyHidden-' + postId);
                if (body && hidden) hidden.value = body.innerHTML.trim();
                var tagHidden = document.getElementById('editTagsHidden-' + postId);
                if (tagHidden) tagHidden.value = collectTags('editTagsWrap-' + postId);
            });
        });

        /* Edit cancel */
        document.querySelectorAll('.edit-cancel-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                if (editSelector) editSelector.value = '';
                loadEditForm('');
            });
        });

        /* Open Edit tab from post dropdown */
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
                var editTab = document.querySelector('.sl-tab[data-panel="edit-panel" ]');
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

        /* ── 4. TAG HELPERS ── */
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

        /* ── 5. RESTORE SESSION STATE (after validation errors) ── */
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

    }); // end DOMContentLoaded

    /* ════════════════════════════════════════
    DELEGATED CLICK HANDLER
    (likes + comments + replies + tags)
    ════════════════════════════════════════ */
    document.addEventListener('click', function(e) {

        /* ── Remove tag pill ── */
        if (e.target.classList.contains('remove-tag-btn')) {
            var pill = e.target.closest('.sl-tag-pill');
            if (pill) pill.remove();
            return;
        }

        /* ── Like / Unlike ── */
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
                        text += users[0] + ', ' + users[1] +
                            ' and <a href="#" class="text-dark fw-semibold text-decoration-none show-likes"' +
                            ' data-post="' + postId + '" data-bs-toggle="modal"' +
                            ' data-bs-target="#likesModal-' + postId + '">' +
                            data.remaining + ' others</a>';
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

        /* ── Show likes modal ── */
        var showLikes = e.target.closest('.show-likes');
        if (showLikes) {
            loadLikesModal(showLikes.dataset.post);
            return;
        }

        /* ── Toggle comment panel ── */
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

        /* ── Post main comment ── */
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

        /* ── Toggle reply input box ── */
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

        /* ── Post reply ── */
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

    /* ════ COMMENT FUNCTIONS ════ */

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
        var av = comment.user.photo ?
            '<img src="' + comment.user.photo + '" alt="">' :
            comment.user.initial;
        var repliesHtml = '';
        if (comment.replies && comment.replies.length)
            comment.replies.forEach(function(r) {
                repliesHtml += buildReplyHtml(r);
            });

        div.innerHTML =
            '<div class="sl-a-avatar">' + av + '</div>' +
            '<div class="sl-a-body">' +
            '<div class="sl-a-bubble">' +
            '<h5>' + escHtml(comment.user.name) + '</h5>' +
            '<p>' + escHtml(comment.comment) + '</p>' +
            '</div>' +
            '<div class="sl-a-meta">' +
            '<span>' + comment.created_at + '</span>' +
            '<button class="reply-toggle-btn" data-comment="' + comment.id + '">Reply</button>' +
            '</div>' +
            '<div id="replyBox-' + comment.id + '" style="display:none;gap:6px;padding:6px 0;align-items:center;">' +
            '<input class="sl-reply-input reply-input" type="text" data-comment="' + comment.id + '" placeholder="Write a reply…" style="flex:1;">' +
            '<button class="sl-btn sl-btn-primary post-reply-btn" data-post="' + postId + '" data-comment="' + comment.id + '" style="padding:5px 12px;font-size:12px;white-space:nowrap;">Reply</button>' +
            '</div>' +
            '<div class="sl-replies" id="replies-' + comment.id + '" style="display:block;">' + repliesHtml + '</div>' +
            '</div>';
        return div;
    }

    function buildReplyHtml(reply) {

        var av = reply.user.photo ?
            '<img src="' + reply.user.photo + '" alt="">' :
            reply.user.initial;

        return '<div class="sl-reply" id="reply-' + reply.id + '">' +
            '<div class="sl-r-avatar">' + av + '</div>' +
            '<div class="sl-r-bubble">' +
            '<h6>' + escHtml(reply.user.name) + '</h6>' +
            '<p>' + escHtml(reply.comment) + '</p>' +
            '<span style="font-size:11px;color:#999;">' + reply.created_at + '</span>' +
            '</div>' +
            '</div>';
    }

    function loadLikesModal(postId) {
        fetch('/posts/' + postId + '/likes')
            .then(function(r) {
                return r.json();
            })
            .then(function(users) {
                var html = users.length ? '' : '<p class="text-muted text-center">No likes yet</p>';
                users.forEach(function(u) {
                    html += '<div class="d-flex align-items-center gap-3 mb-3">';
                    html += u.photo ?
                        '<img src="' + u.photo + '" class="rounded-circle" width="40" height="40" style="object-fit:cover;">' :
                        '<div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;"><i class="bi bi-person-fill text-secondary"></i></div>';
                    html += '<div class="fw-semibold">' + escHtml(u.name) + '</div>'
                    '</div>';
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
    const qForm = document.getElementById('qForm');
    const tagInput = document.getElementById('qTagIn');
    const hiddenTags = document.getElementById('qTagsHidden');

    if (qForm) {

        let tagsArray = [];

        tagInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();

                let tag = tagInput.value.trim().toLowerCase();

                if (tag && !tagsArray.includes(tag)) {
                    tagsArray.push(tag);
                    hiddenTags.value = tagsArray.join(',');
                    tagInput.value = '';
                }
            }
        });

        qForm.addEventListener('submit', function() {
            hiddenTags.value = tagsArray.join(',');
        });

    }

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
        }

    }
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');

        if (searchInput) {
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    form.submit();
                }
            });
        }

    });
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
</script>
@endsection