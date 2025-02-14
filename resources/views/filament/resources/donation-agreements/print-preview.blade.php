<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Agreement - Print Preview</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { width: 80%; margin: auto; }
        .title { text-align: center; font-size: 24px; font-weight: bold; }
        .content { margin-top: 20px; }
        .section { margin-bottom: 15px; }
        .label { font-weight: bold; }
        .signature { margin-top: 30px; text-align: center; font-style: italic; }
    </style>
</head>
<body>

<div class="container">
    <div class="title">Donation Agreement</div>

    <div class="content">
        <div class="section">
            <span class="label">Supporter:</span> {{ $donationAgreement->supporter->name }}
        </div>
        <div class="section">
            <span class="label">Bank Form:</span> {{ $donationAgreement->bankForm->form_name }}
        </div>
        <div class="section">
            <span class="label">Donation Type:</span> {{ ucfirst($donationAgreement->donation_type) }}
        </div>
        <div class="section">
            <span class="label">Donation Amount:</span> ${{ number_format($donationAgreement->donation_amount, 2) }}
        </div>
        @if($donationAgreement->recurring_interval)
        <div class="section">
            <span class="label">Recurring Interval:</span> {{ ucfirst($donationAgreement->recurring_interval) }}
        </div>
        @endif
        <div class="section">
            <span class="label">Signed Agreement:</span>
            <a href="{{ asset($donationAgreement->signed_agreement_pdf) }}" target="_blank">View PDF</a>
        </div>

        <div class="signature">Signed Agreement Document</div>
    </div>
</div>

<script>
    window.onload = function () {
        window.print();
    };
</script>

</body>
</html>
