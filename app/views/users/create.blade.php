@extends('layouts.master')

@section('head')
{{ HTML::style('css/zocial/zocial.css') }}


@stop

@section('breadcrumbs')
{{ Breadcrumbs::render('register') }}
@stop

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-0 col-md-offset-1">
        {{ Form::open(['route' => 'users.store', 'role' => 'form']) }}
        <h2>Please Sign Up <small>It's free and always will be.</small></h2>
        <hr class="colorgraph">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    {{ Form::text('firstname', null, ['class'=>'form-control input-lg', 'placeholder'=>'First Name', 'tabindex'=>'1']) }}
                    {{ $errors->first('firstname') }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    {{ Form::text('lastname', null, ['class'=>'form-control input-lg', 'placeholder'=>'Last Name', 'tabindex'=>'2']) }}
                    {{ $errors->first('lastname') }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::text('username', null, ['class'=>'form-control input-lg', 'placeholder'=>'User Name', 'tabindex'=>'3']) }}
            {{ $errors->first('username') }}
        </div>
        <div class="form-group">
            {{ Form::email('email', null, ['class'=>'form-control input-lg', 'placeholder'=>'Email', 'tabindex'=>'4']) }}
            {{ $errors->first('email') }}
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    {{ Form::password('password', ['class'=>'form-control input-lg', 'placeholder'=>'Password', 'tabindex'=>'5']) }}
                    {{ $errors->first('password') }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    {{ Form::password('password_confirmation', ['class'=>'form-control input-lg', 'placeholder'=>'Confirm Password', 'tabindex'=>'6']) }}
                    {{ $errors->first('password_confirmation') }}
                </div>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="info" tabindex="7">I Agree</button>
                    <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
                </span>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9">
                By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
            </div>
        </div>-->

        <hr class="colorgraph">
        <div class="row">
            <div class="col-xs-6 col-md-6">
                {{ Form::submit('Register', array('class'=>'btn btn-primary btn-block btn-lg', 'tabindex'=>'7'))}}
            </div>
            <div class="col-xs-6 col-md-6">
                {{ link_to(route('sessions.create'), 'Login', ['class' => 'btn btn-success btn-block btn-lg']) }}
            </div>
        </div>
        </form>
    </div>

    <div class="col-xs-12 col-sm-3 col-md-4 col-sm-offset-0 col-md-offset-0">
        {{ Form::open(['route' => 'sessions.store', 'role' => 'form']) }}
        <h2>...Or Sign In With</h2>
        <hr class="colorgraph">
        <ul class="nav">
            <li class="margin-bottom-10">
                {{ link_to(route('oauth.create', 'facebook'), 'Facebook', ['class' => 'zocial facebook']) }}
            </li>
            <li>
                {{ link_to(route('oauth.create', 'twitter'), 'Twitter', ['class' => 'zocial twitter']) }}
            </li>
        </ul>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                <p>Om ruzie op onze website te vermijden hebben we regels samengesteld waar men als bezoeker mee <strong>akkoord</strong> moet <strong>gaan</strong>. Wanneer men de regels overtreedt krijgt men een waarschuwing of een ban bij meerdere overtredingen.
                <hr noshade></P>
                <h5>1. Gedrag:</h5>
                <p>Er mogen geen racistische opmerkingen gemaakt worden op Sitemasters.be.<br>
                    Ook schelden is niet toegelaten.</p>
                <h5>2. Reclame:</h5>
                <p>Het plaatsen van reclame is niet gewenst op Sitemasters.be. Enkel als men toestemming krijgt van de webmasters is het toegestaan. Links naar Porno/Warez/Clickgames zijn ten strengste verboden !</p>
                <h5>3. Geen geflood:</h5>
                <p>Er mag niet geflood worden op Sitemasters.be. Hiermee bedoelen we geen overbodige of herhalende teksten, geen volledige scripts posten in het forum, ...</p>
                <h5>4. Kopi&euml;ren van inhoud:</h5>
                <p>Het kopi&euml;ren van inhoud (tekst, afbeeldingen, lay-out, ...) is verboden zonder toestemming van de beheerder. </p>
                <h5>5. Taalgebruik:</h5>
                <p> Schrijf je berichten in het Algemeen Nederlands. Gebruik leestekens waar nodig, geen zelf uitgevonden afkortingen en geen MSN-taal. Hou er rekening mee dat hier Nederlandstalige mensen uit verschillende streken bijeenkomen, en zo ook verschillende dialecten. Het ABN biedt hier dus weeral een ideale middenweg, hou je hier dan ook aan. </p>
                <h5>6. Scripts:</h5>
                <p>Het kopi&euml;ren van scripts van een andere website is verboden. Enkel zelf gemaakte scripts mogen gepost worden. Wanneer je een script wil posten kijk je eerst of er al een ongeveer zelfde script is gepost. Dit is om te voorkomen dat er hetzelfde script in komt te staan.</p>
                <h5>7. Forum:</h5>
                Bij gebruikmaking van het forum dienen de volgende regels in acht te worden genomen:
                <ol>
                    <li><b>voor het plaatsen van een bericht</b><br />
                        Zorg dat je de volgende twee dingen hebt gedaan voordat je een nieuw bericht plaatst,<br />
                        het kan	namelijk zijn dat je vraag al beantwoord is:
                        <ul>
                            <li>kijk in de <a href="http://www.sitemasters.be/FAQ" target="_blank"><b>categorieën van de FAQ</b></a></li>
                            <li>gebruik de <a href="http://www.sitemasters.be/forum/zoek" target="_blank"><b>zoekfunctie van het forum</b></a></li>
                        </ul>
                    </li>

                    <li><b>bij het plaatsen van een bericht</b><br />
                        <ul>
                            <li>geef het onderwerp van een bericht een <u>omschrijvende</u> titel<br /></li>
                            <li>geef in het bericht een <u>duidelijke omschrijving van het probleem</u> of een <u>concrete foutmelding</u></li>
                            <li>voorzie het bericht eventueel van <u>codefragmenten</u> (<b>géén</b> lappen text)</li>
                            <li>vermeld erbij wat het <i>gewenste gedrag</i> van de code is en hoe jouw code hier van afwijkt</li>
                            <li>plaats het zelfde bericht niet op meerdere fora; als je vind dat er een forum ontbreekt, meld dit dan
                                aan een medewerker</li>
                            <li>het forum is een plaats waar mensen elkaar proberen te helpen, start hier dus geen flamewars</li>
                        </ul>
                    </li>

                    <li><b>na het plaatsen van een bericht</b><br />
                        <ul>
                            <li>plaats geen (directe) reacties op eigen berichten en eigen reacties<br />
                                wanneer mensen iets bij kunnen dragen aan de discussie of aan de oplossing van een probleem,
                                is het aan hun om te bepalen of en wanneer ze reageren, niet aan de starter van het bericht</li>
                            <li>laat weten wanneer een probleem is opgelost, zodat medewerkers het bericht kunnen sluiten</li>
                        </ul>
                    </li>

                    <li><b>bij het plaatsen van een reactie</b><br />
                        <ul>
                            <li>plaats een reactie als je denkt een <u>zinvolle bijdrage</u> te kunnen leveren aan de discussie</li>
                            <li>probeer ontopic te blijven - zinloze spam zal door onze bikkelharde medewerkers worden geneutraliseerd :)</li>
                            <li>probeer oplossingen toe te lichten (bijvoorbeeld door commentaar in code toe te voegen) - het is vaak
                                interessanter om te zien hoe je tot een oplossing gekomen bent (of waarom je voor die oplossing gekozen hebt)
                                dan het geven van enkel de oplossing zelf; het toelichten van oplossingen draagt bij aan het <u>begrip</u></li>
                        </ul>
                    </li>
                </ol>
                <h5>8. Cracken &amp; Hacken:</h5>
                <p>Het proberen te cracken/hacken op Sitemasters is verboden. Dit zal dan ook zwaar worden gestraft.<br>
                    <br>
                    <strong>9. Informatie op Sitemasters:</strong><br>
                    <br>
                    Alle content (tutorials, scripts, forumberichten, wormdelen, ...) die op Sitemasters is gepost, is eigendom van Sitemasters en mag dan ook later niet verwijderd worden.</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop