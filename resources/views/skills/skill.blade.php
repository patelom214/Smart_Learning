@extends('layouts.app')

@section('title', 'Skills')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@500;600;700&family=Satoshi:wght@400;500;700&display=swap" rel="stylesheet">
<style>
:root {
    --ink:     #0f0f1a;
    --soft:    #f5f4f0;
    --card:    #ffffff;
    --accent:  #5b4cff;
    --accent2: #ff5fa0;
    --muted:   #8884a0;
    --border:  #ebebf5;
    --added:   #00c48c;
}

body { font-family: 'Satoshi', sans-serif; background: var(--soft); }

/* ── Page header ── */
.sk-hero {
    padding: 56px 0 40px;
    text-align: center;
}
.sk-hero h1 {
    font-family: 'Clash Display', sans-serif;
    font-size: clamp(28px, 5vw, 48px);
    font-weight: 700;
    color: var(--ink);
    letter-spacing: -.5px;
    margin-bottom: 10px;
}
.sk-hero p { font-size: 16px; color: var(--muted); }

/* ── Search / filter bar ── */
.sk-filterbar {
    display: flex;
    align-items: center;
    gap: 12px;
    max-width: 480px;
    margin: 0 auto 44px;
    background: #fff;
    border: 1.5px solid var(--border);
    border-radius: 50px;
    padding: 8px 8px 8px 20px;
    box-shadow: 0 4px 16px rgba(91,76,255,.08);
}
.sk-filterbar input {
    flex: 1;
    border: none;
    outline: none;
    font-family: 'Satoshi', sans-serif;
    font-size: 14px;
    color: var(--ink);
    background: transparent;
}
.sk-filterbar input::placeholder { color: #c0bdce; }
.sk-filterbar button {
    background: linear-gradient(135deg, var(--accent), #8b7fff);
    border: none;
    color: #fff;
    padding: 8px 20px;
    border-radius: 40px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    font-family: 'Satoshi', sans-serif;
}

/* ── Grid ── */
.sk-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
    gap: 24px;
    padding-bottom: 60px;
}

/* ── Card ── */
.sk-card {
    background: var(--card);
    border-radius: 20px;
    border: 1.5px solid var(--border);
    padding: 28px 24px 22px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    transition: transform .3s ease, box-shadow .3s ease, border-color .3s;
    position: relative;
    overflow: hidden;
    animation: cardIn .4s ease both;
}

.sk-card:nth-child(1)  { animation-delay: .04s; }
.sk-card:nth-child(2)  { animation-delay: .08s; }
.sk-card:nth-child(3)  { animation-delay: .12s; }
.sk-card:nth-child(4)  { animation-delay: .16s; }
.sk-card:nth-child(5)  { animation-delay: .20s; }
.sk-card:nth-child(6)  { animation-delay: .24s; }

@keyframes cardIn {
    from { opacity:0; transform:translateY(18px); }
    to   { opacity:1; transform:translateY(0);    }
}

.sk-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(91,76,255,.12);
    border-color: rgba(91,76,255,.25);
}

/* Added state accent line */
.sk-card.is-added { border-color: rgba(0,196,140,.3); }
.sk-card.is-added::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--added), #00e5a8);
}

/* Icon blob */
.sk-icon {
    width: 48px; height: 48px;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(91,76,255,.1), rgba(139,127,255,.15));
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    margin-bottom: 4px;
}

.sk-card.is-added .sk-icon {
    background: linear-gradient(135deg, rgba(0,196,140,.1), rgba(0,229,168,.15));
}

.sk-name {
    font-family: 'Clash Display', sans-serif;
    font-size: 17px;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
}

.sk-desc {
    font-size: 13.5px;
    color: var(--muted);
    line-height: 1.55;
    flex: 1;
    margin: 0;
}

/* Added badge */
.sk-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .04em;
    color: var(--added);
    background: rgba(0,196,140,.1);
    border-radius: 30px;
    padding: 3px 10px;
    width: fit-content;
}

/* Actions row */
.sk-actions {
    display: flex;
    gap: 8px;
    margin-top: 6px;
}

.sk-btn {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 9px 14px;
    border-radius: 30px;
    font-family: 'Satoshi', sans-serif;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: all .2s ease;
    white-space: nowrap;
}

.sk-btn-add {
    background: linear-gradient(135deg, var(--accent), #8b7fff);
    color: #fff;
    box-shadow: 0 4px 14px rgba(91,76,255,.3);
}
.sk-btn-add:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(91,76,255,.4);
    color: #fff;
}

.sk-btn-remove {
    background: rgba(255,77,109,.08);
    color: #ff4d6d;
    border: 1.5px solid rgba(255,77,109,.2);
}
.sk-btn-remove:hover {
    background: #ff4d6d;
    color: #fff;
    border-color: #ff4d6d;
}

.sk-btn-roadmap {
    background: var(--soft);
    color: var(--ink);
    border: 1.5px solid var(--border);
    flex: none;
    padding: 9px 16px;
}
.sk-btn-roadmap:hover {
    background: var(--ink);
    color: #fff;
    border-color: var(--ink);
}

/* ── Empty state ── */
.sk-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    color: var(--muted);
}
.sk-empty .sk-empty-icon { font-size: 48px; margin-bottom: 12px; }
.sk-empty h4 { font-size: 18px; color: var(--ink); font-family: 'Clash Display', sans-serif; }
</style>
@endpush

@section('content')

<div class="container">
    <div class="sk-hero">
        <h1>✦ Your Skills</h1>
        <p>Add skills to get personalised roadmaps and track your learning journey.</p>
    </div>

    {{-- Search --}}
    <div class="sk-filterbar">
        <input type="text" id="skillSearch" placeholder="Search skills…">
        <button onclick="filterSkills()">Search</button>
    </div>

    {{-- Grid --}}
    <div class="sk-grid" id="skillGrid">

        @forelse($skills as $skill)
        @php $added = in_array($skill->id, $userSkills); @endphp

        <div class="sk-card {{ $added ? 'is-added' : '' }}" data-name="{{ strtolower($skill->skill_name) }}">

            {{-- Icon --}}
            <div class="sk-icon">{{ $skill->icon ?? '🎯' }}</div>

            {{-- Added badge --}}
            @if($added)
                <span class="sk-badge">✔ Added</span>
            @endif

            <h5 class="sk-name">{{ $skill->skill_name }}</h5>
            <p class="sk-desc">{{ $skill->description }}</p>

            {{-- Actions --}}
            <div class="sk-actions">

                {{-- Add / Remove --}}
                <form action="{{ route('skills.toggle', $skill->id) }}" method="POST" style="flex:1;display:flex;">
                    @csrf
                    @if($added)
                        <button class="sk-btn sk-btn-remove">✕ Remove</button>
                    @else
                        <button class="sk-btn sk-btn-add">＋ Add Skill</button>
                    @endif
                </form>

                {{-- View Roadmap --}}
                <a href="{{ route('roadmap.show', $skill->id) }}" class="sk-btn sk-btn-roadmap">
                    🗺 Roadmap
                </a>

            </div>
        </div>

        @empty
        <div class="sk-empty">
            <div class="sk-empty-icon">🔍</div>
            <h4>No skills found</h4>
            <p>Check back later for new skills.</p>
        </div>
        @endforelse

    </div>
</div>

@endsection

@push('scripts')
<script>
function filterSkills() {
    const q = document.getElementById('skillSearch').value.toLowerCase();
    document.querySelectorAll('.sk-card').forEach(card => {
        card.style.display = card.dataset.name.includes(q) ? '' : 'none';
    });
}
document.getElementById('skillSearch').addEventListener('keyup', filterSkills);
</script>
@endpush