@component('mail::message')

<h1 style="text-align: right !important">لقد تلقينا طلبك للتحقق من بريدك الإلكتروني</h1>

<p style="text-align: right !important">يمكنك استخدام الرمز التالي للتحقق من حسابك:</p>

@component('mail::panel')
{{ $code }}
@endcomponent

<p style="text-align: right !important">المدة المسموح بها للرمز هي ساعة واحدة من وقت إرسال الرسالة</p>

@endcomponent
