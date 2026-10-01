<?php
$title = "Run with me this Saturday?";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
	<style>
		:root {
			--ink: #17251f;
			--muted: #66736d;
			--paper: #fffdf7;
			--green: #286b4f;
			--green-dark: #1d513b;
			--coral: #e8785d;
			--line: #dce7df;
		}

		* { box-sizing: border-box; }

		body {
			margin: 0;
			width: 100%;
			min-height: 100vh;
			min-height: 100dvh;
			display: grid;
			place-items: center;
			padding: clamp(12px, 4vw, 24px);
			overflow-x: hidden;
			overflow-y: auto;
			color: var(--ink);
			background:
				radial-gradient(circle at 12% 15%, rgba(232, 120, 93, .22) 0 8%, transparent 9%),
				radial-gradient(circle at 88% 84%, rgba(40, 107, 79, .16) 0 12%, transparent 13%),
				#eaf3ed;
			font-family: Georgia, "Times New Roman", serif;
		}

		.invitation {
			position: relative;
			width: min(100%, 560px);
			max-width: 100%;
			overflow: hidden;
			background: var(--paper);
			border: 1px solid rgba(40, 107, 79, .18);
			border-radius: 18px;
			box-shadow: 0 24px 60px rgba(23, 37, 31, .14);
			animation: arrive .7s ease-out both;
		}

		.top {
			padding: clamp(28px, 7vw, 42px) clamp(20px, 6vw, 34px) 30px;
			color: #f7fff9;
			background: var(--green);
			text-align: center;
		}

		.eyebrow {
			margin: 0 0 18px;
			color: #b9dcc9;
			font: 700 12px/1.2 Arial, sans-serif;
			letter-spacing: 2px;
			text-transform: uppercase;
		}

		h1 {
			max-width: 430px;
			margin: 0 auto;
			font-size: clamp(32px, 9vw, 56px);
			font-weight: 400;
			line-height: .98;
		}

		.intro {
			max-width: 360px;
			margin: 20px auto 0;
			color: #d9eee1;
			font-size: 17px;
			line-height: 1.5;
		}

		.details {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 12px;
			padding: clamp(20px, 5vw, 26px) clamp(18px, 5vw, 28px) 10px;
		}

		.detail {
			padding: 16px 12px;
			border: 1px solid var(--line);
			border-radius: 10px;
			text-align: center;
		}

		.detail-label {
			display: block;
			margin-bottom: 7px;
			color: var(--coral);
			font: 700 11px/1.2 Arial, sans-serif;
			letter-spacing: 1.5px;
			text-transform: uppercase;
		}

		.detail strong { font-size: 18px; font-weight: 400; }

		.question {
			margin: 20px 28px 0;
			color: var(--muted);
			font-size: 17px;
			text-align: center;
		}

		.actions {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 12px;
			padding: 18px clamp(18px, 5vw, 28px) 30px;
		}

		button {
			width: 100%;
			min-height: 52px;
			border: 0;
			border-radius: 8px;
			cursor: pointer;
			font: 700 16px Arial, sans-serif;
			transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
		}

		button:hover, button:focus-visible {
			transform: translateY(-2px);
			box-shadow: 0 8px 18px rgba(23, 37, 31, .16);
		}

		.yes { color: #fff; background: var(--coral); }
		.yes:hover, .yes:focus-visible { background: #d9674c; }
		.no { color: var(--green-dark); background: #e3eee7; }
		.no:hover, .no:focus-visible { background: #d2e5d9; }
		.no.dodging {
			position: absolute !important;
			z-index: 10;
			width: max-content;
		}

		#response {
			min-height: 24px;
			margin: 0 28px 28px;
			color: var(--green-dark);
			font: 700 15px/1.5 Arial, sans-serif;
			text-align: center;
		}

		@keyframes arrive {
			from { opacity: 0; transform: translateY(14px); }
			to { opacity: 1; transform: translateY(0); }
		}

		@media (max-width: 430px) {
			body { place-items: start center; }
			.top { padding-bottom: 26px; }
			.details { grid-template-columns: 1fr; }
			.actions { grid-template-columns: 1fr; }
			.question, #response { margin-left: 18px; margin-right: 18px; }
		}
	</style>
</head>
<body>
	<main class="invitation" aria-labelledby="invitation-title">
		<section class="top">
			<p class="eyebrow">A little weekend adventure</p>
			<h1 id="invitation-title">Run with Us this Saturday?</h1>
			<p class="intro">Fresh air, good conversation, and a well-earned coffee afterward.</p>
		</section>

		<section class="details" aria-label="Run details">
			<div class="detail">
				<span class="detail-label">When</span>
				<strong>Saturday<br>7:00 PM</strong>
			</div>
			<div class="detail">
				<span class="detail-label">Where</span>
				<strong>Lipa City<br>Bypass</strong>
			</div>
		</section>

		<p class="question">Will you join me for an easy, fun run?</p>
		<div class="actions">
			<button class="yes" type="button" onclick="answerYes()">Yes, I am in!</button>
			<button class="no" type="button" onclick="answerNo()">Maybe next time</button>
		</div>
		<p id="response" role="status" aria-live="polite"></p>
	</main>

	<script>
		function answerYes() {
			document.getElementById('response').textContent = "Amazing! See you Saturday at the main gate.";
		}

		function answerNo() {
			moveNoButton();
		}

		function moveNoButton() {
			const noButton = document.querySelector('.no');
			const invitation = document.querySelector('.invitation');
			const edgePadding = 12;

			noButton.classList.add('dodging');
			noButton.style.display = 'block';
			const maxX = Math.max(edgePadding, invitation.clientWidth - noButton.offsetWidth - edgePadding);
			const maxY = Math.max(edgePadding, invitation.clientHeight - noButton.offsetHeight - edgePadding);
			noButton.style.left = `${edgePadding + Math.random() * (maxX - edgePadding)}px`;
			noButton.style.top = `${edgePadding + Math.random() * (maxY - edgePadding)}px`;
			document.getElementById('response').textContent = "That button is feeling shy. Try Yes instead!";
		}
	</script>
</body>
</html>
