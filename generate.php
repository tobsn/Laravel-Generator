<?php

/**
 * Laravel Generator
 * 
 * Rapidly create models, views, migrations + schema, assets, etc.
 *
 * USAGE:
 * Add this file to your Laravel application/tasks directory
 * and call the methods with: php artisan generate:[model|controller|migration] [args]
 * 
 * See individual methods for additional usage instructions.
 * 
 * @author      Jeffrey Way <jeffrey@jeffrey-way.com>
 * @license     haha - whatever you want.
 * @version     0.8
 * @since       July 26, 2012
 *
 */
class Generate_Task
{

    /*
     * Set these paths to the location of your assets.
     */
    public static $css_dir = 'css/';
    public static $sass_dir  = 'css/sass/';
    public static $less_dir  = 'css/less/';
    public static $css_vendors_dir = 'css/vendors/';

    public static $js_dir  = 'js/';
    public static $coffee_dir  = 'js/coffee/';
    public static $js_vendors_dir  = 'js/vendors/';

    /*
     * The content for the generate file
     */
    public static $content;

    /*
     * List of supported libraries
     */

    public static $libraries = array(
        'ace' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/ace/0.2.0/ace.js',
            'http://ace.ajax.org/' ),
        'alloy-ui' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/alloy-ui/1.0.1/aui-min.js',
            'https://github.com/liferay/alloy-ui' ),
        'angular' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.0.1/angular.min.js',
            'http://angularjs.org' ),
        'augment' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/augment.js/0.4.0/augment.min.js',
            'http://augmentjs.com' ),
        'backbone-localstorage' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/backbone-localstorage.js/1.0/backbone.localStorage-min.js',
            'https://github.com/jeromegn/Backbone.localStorage' ),
        'backbone' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.2/backbone-min.js',
            'http://documentcloud.github.com/backbone/' ),
        'backbone.modelbinder' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/backbone.modelbinder/0.1.5/Backbone.ModelBinder.min.js',
            'https://github.com/theironcook/Backbone.ModelBinder#prerequisites' ),
        'benchmark' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/benchmark/0.3.0/benchmark.min.js',
            'http://benchmarkjs.com/' ),
        'camanjs' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/camanjs/3.2/caman.full.min.js',
            'http://camanjs.com/' ),
        'chosen' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/chosen/0.9.8/chosen.jquery.min.js',
            'http://harvesthq.github.com/chosen' ),
        'chrome-frame' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js',
            'http://code.google.com/chrome/chromeframe/' ),
        'coffee-script' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/coffee-script/1.3.3/coffee-script.min.js',
            'http://jashkenas.github.com/coffee-script/' ),
        'crafty' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/crafty/0.4.9/crafty-min.js',
            'http://craftyjs.com/' ),
        'css3finalize' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/css3finalize/3.1/jquery.css3finalize.min.js',
            'https://github.com/codler/jQuery-Css3-Finalize' ),
        'css3pie' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/css3pie/1.0.0/PIE.js',
            'http://css3pie.com' ),
        'cufon' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/cufon/1.09i/cufon-yui.js',
            'http://cufon.shoqolate.com/' ),
        'd3' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/d3/2.10.0/d3.v2.min.js',
            'http://mbostock.github.com/d3/' ),
        'datatables' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/datatables/1.9.3/jquery.dataTables.min.js',
            'http://datatables.net' ),
        'datatables-fixedheader' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/datatables-fixedheader/2.0.6/FixedHeader.min.js',
            'http://datatables.net/extras/fixedheader/' ),
        'datejs' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js',
            'http://www.datejs.com' ),
        'davis' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/davis.js/0.7.0/davis.min.js',
            'http://davisjs.com' ),
        'dd_belatedpng' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/dd_belatedpng/0.0.8/dd_belatedpng.min.js',
            'http://www.dillerdesign.com/experiment/DD_belatedPNG/' ),
        'documentup' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/documentup/0.1.1/documentup.min.js',
            'http://documentup.com' ),
        'dojo' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/dojo/1.7.2/dojo.js',
            'http://dojotoolkit.org/' ),
        'dropbox' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/dropbox.js/0.6.1/dropbox.min.js',
            'https://dropbox.com/developers' ),
        'dygraph' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/dygraph/1.2/dygraph-combined.js',
            'http://dygraphs.com/' ),
        'embedly-jquery' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/embedly-jquery/2.2.0/jquery.embedly.min.js',
            'https://github.com/embedly/embedly-jquery' ),
        'ember' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/ember.js/1.0.pre/ember-1.0.pre.min.js',
            'http://emberjs.com/' ),
        'es5-shim' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/es5-shim/1.2.4/es5-shim.min.js',
            'https://github.com/kriskowal/es5-shim' ),
        'ext-core' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/ext-core/3.1.0/ext-core.js',
            'http://www.sencha.com/products/extjs/' ),
        'fancybox' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.0.6/jquery.fancybox.pack.js',
            'http://fancyapps.com/fancybox/' ),
        'firebug-lite' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/firebug-lite/1.4.0/firebug-lite.js',
            'https://getfirebug.com/firebuglite/' ),
        'flexie' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/flexie/1.0.0/flexie.min.js',
            'http://flexiejs.com/' ),
        'flot' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/flot/0.7/jquery.flot.min.js',
            'http://code.google.com/p/flot/' ),
        'galleria' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/galleria/1.2.7/galleria.min.js',
            'http://galleria.aino.se' ),
        'graphael' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/graphael/0.5.0/g.raphael-min.js',
            'http://g.raphaeljs.com/' ),
        'handlebars' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.0.beta6/handlebars.min.js',
            'http://www.handlebarsjs.com' ),
        'hashgrid' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/hashgrid/6/hashgrid.js',
            'http://hashgrid.com/' ),
        'headjs' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/headjs/0.96/head.min.js',
            'http://headjs.com/' ),
        'highcharts' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/highcharts/2.3.1/highcharts.js',
            'http://highcharts.com/' ),
        'history' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/history.js/1.7.1/native.history.js',
            'https://github.com/balupton/History.js/' ),
        'hogan' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/hogan.js/2.0.0/hogan.js',
            'http://twitter.github.com/hogan.js/' ),
        'html5shiv' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6/html5shiv.min.js',
            'https://github.com/aFarkas/html5shiv' ),
        'ICanHaz' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/ICanHaz.js/0.10/ICanHaz.min.js',
            'http://icanhazjs.com' ),
        'javascript-state-machine' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/javascript-state-machine/2.0.0/state-machine.min.js',
            'https://github.com/jakesgordon/javascript-state-machine' ),
        'jo' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jo/0.4.1/jo.min.js',
            'http://joapp.com' ),
        'jquery' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.1/jquery.min.js',
            'http://jquery.com/' ),
        'jquery-cookie' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.2/jquery.cookie.js',
            'https://github.com/carhartl/jquery-cookie' ),
        'jquery-easing' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
            'http://gsgd.co.uk/sandbox/jquery/easing/' ),
        'jquery-gamequery' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-gamequery/0.6.2/jquery.gamequery.min.js',
            'http://gamequeryjs.com' ),
        'jquery-hashchange' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-hashchange/v1.3/jquery.ba-hashchange.min.js',
            'http://benalman.com/projects/jquery-hashchange-plugin/' ),
        'jquery-history' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-history/1.9/jquery.history.js',
            'https://github.com/tkyk/jquery-history-plugin' ),
        'jquery-infinitescroll' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.0b2.110713/jquery.infinitescroll.min.js',
            'http://www.infinite-scroll.com/infinite-scroll-jquery-plugin/' ),
        'jquery-mockjax' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-mockjax/1.5.1/jquery.mockjax.js',
            'http://code.appendto.com/plugins/jquery-mockjax/' ),
        'jquery-mousewheel' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.0.6/jquery.mousewheel.min.js',
            'http://brandonaaron.net/code/mousewheel/docs' ),
        'jquery-nivoslider' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.1/jquery.nivo.slider.pack.js',
            'http://nivo.dev7studios.com' ),
        'jquery-scrollTo' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.3/jquery.scrollTo.min.js',
            'http://flesler.blogspot.com/2007/10/jqueryscrollto.html' ),
        'jquery-textext' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-textext/1.3.0/jquery.textext.min.js',
            'http://textextjs.com/' ),
        'jquery-throttle-debounce' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js',
            'https://github.com/cowboy/jquery-throttle-debounce' ),
        'jquery-timeago' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/0.9.3/jquery.timeago.js',
            'http://timeago.yarp.com/' ),
        'jquery-tools' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-tools/1.2.6/jquery.tools.min.js',
            'http://flowplayer.org/tools/index.html' ),
        'jquery-validate' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.9.0/jquery.validate.min.js',
            'http://bassistance.de/jquery-plugins/jquery-plugin-validation//' ),
        'jquery.colorbox' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.3.20.1/jquery.colorbox-min.js',
            'http://www.jacklmoore.com/colorbox' ),
        'jquery.cycle' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery.cycle/2.99/jquery.cycle.all.min.js',
            'http://jquery.malsup.com/cycle/' ),
        'jquery.formalize' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery.formalize/1.2/jquery.formalize.min.js',
            'http://formalize.me/' ),
        'jquery.nanoscroller' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery.nanoscroller/0.6.8/jquery.nanoscroller.min.js',
            'http://jamesflorentino.github.com/nanoScrollerJS/' ),
        'jquery.SPServices' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery.SPServices/0.7.1a/jquery.SPServices-0.7.1a.min.js',
            'http://spservices.codeplex.com/' ),
        'jquery.transit' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.1.3/jquery.transit.min.js',
            'http://ricostacruz.com/jquery.transit/' ),
        'jqueryui' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js',
            'http://jqueryui.com/' ),
        'jqueryui-touch-punch' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js',
            'http://touchpunch.furf.com/' ),
        'js-signals' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/js-signals/0.6.1/js-signals.min.js',
            'http://millermedeiros.github.com/js-signals/' ),
        'jScrollPane' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jScrollPane/2.0.0beta12/jquery.jscrollpane.min.js',
            'http://jscrollpane.kelvinluck.com' ),
        'json2' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/json2/20110223/json2.js',
            'https://github.com/douglascrockford/JSON-js' ),
        'json3' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/json3/3.2.3/json3.min.js',
            'http://bestiejs.github.com/json3' ),
        'jStorage' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jStorage/0.1.6.1/jstorage.min.js',
            'http://jstorage.info/' ),
        'jsxgraph' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.94/jsxgraphcore.js',
            'http://jsxgraph.org/' ),
        'kerning' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/kerning.js/0.2/kerning.min.js',
            'http://kerningjs.com/' ),
        'knockout' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/knockout/2.1.0/knockout-min.js',
            'http://knockoutjs.com/' ),
        'knockout.mapping' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/knockout.mapping/2.3.2/knockout.mapping.js',
            'http://knockoutjs.com/documentation/plugins-mapping.html' ),
        'labjs' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/labjs/2.0.3/LAB.min.js',
            'http://labjs.com/' ),
        'less' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/less.js/1.3.0/less-1.3.0.min.js',
            'http://lesscss.org/' ),
        'lodash' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/lodash.js/0.7.0/lodash.min.js',
            'http://lodash.com' ),
        'masonry' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/masonry/2.1.04/jquery.masonry.min.js',
            'http://masonry.desandro.com/' ),
        'mobilizejs' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/mobilizejs/0.9/mobilize.min.js',
            'http://mobilizejs.com' ),
        'modernizr' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js',
            'http://www.modernizr.com/' ),
        'moment' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/moment.js/1.7.0/moment.min.js',
            'http://momentjs.com/' ),
        'mootools' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/mootools/1.3.2/mootools-yui-compressed.js',
            'http://mootools.net/' ),
        'morris' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.2.9/morris.min.js',
            'http://oesmith.github.com/morris.js/' ),
        'mustache' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.5.0-dev/mustache.min.js',
            'https://github.com/janl/mustache.js' ),
        'ninjaui' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/ninjaui/1.0.1/jquery.ninjaui.min.js',
            'http://ninjaui.com/' ),
        'noisy' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/noisy/1.1/jquery.noisy.min.js',
            'http://rappdaniel.com/noisy/' ),
        'ocanvas' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/ocanvas/2.2.1/ocanvas.min.js',
            'http://ocanvas.org/' ),
        'openajax-hub' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/openajax-hub/2.0.7/OpenAjaxUnmanagedHub.min.js',
            'http://www.openajax.org/member/wiki/OpenAjax_Hub_1.0_Specification' ),
        'openlayers' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/OpenLayers.js',
            'http://openlayers.org/' ),
        'pagedown' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/pagedown/1.0/Markdown.Converter.js',
            'http://code.google.com/p/pagedown/wiki/PageDown' ),
        'paper' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/paper.js/0.22/paper.js',
            'http://paperjs.org/' ),
        'path' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/path.js/0.8.4/path.min.js',
            'https://github.com/mtrpcic/pathjs' ),
        'pie' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/pie/1.0beta5/PIE.js',
            'http://css3pie.com/' ),
        'platform' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/platform/0.4.0/platform.min.js',
            'https://github.com/bestiejs/platform.js' ),
        'prefixfree' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.6/prefixfree.min.js',
            'http://leaverou.github.com/prefixfree/' ),
        'prettify' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/prettify/188.0.0/prettify.js',
            'http://code.google.com/p/google-code-prettify/' ),
        'processing' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/processing.js/1.3.6/processing-api.min.js',
            'http://processingjs.org' ),
        'prototype' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/prototype/1.7.1.0/prototype.js',
            'http://prototypejs.org/' ),
        'psd' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/psd.js/0.4.5/psd.min.js',
            'http://meltingice.github.com/psd.js/' ),
        'pubnub' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/pubnub/3.1.2/pubnub.min.js',
            'http://www.pubnub.com/' ),
        'punycode' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/punycode/1.0.0/punycode.min.js',
            'http://mths.be/punycode' ),
        'raphael' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
            'http://raphaeljs.com/' ),
        'raven' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/raven.js/0.5.3/raven.min.js',
            'https://github.com/lincolnloop/raven-js' ),
        'remoteStorage' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/remoteStorage/0.6.9/remoteStorage.min.js',
            'http://remotestoragejs.com' ),
        'require' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/require.js/0.26.0/require.min.js',
            'https://github.com/jrburke/require-jquery' ),
        'require' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/require.js/2.0.6/require.min.js',
            'http://requirejs.org/' ),
        'respond' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js',
            'https://github.com/scottjehl/Respond' ),
        'ResponsiveSlides' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/ResponsiveSlides.js/1.32/responsiveslides.min.js',
            'http://responsive-slides.viljamis.com/' ),
        'retina' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/retina.js/1.0.1/retina.js',
            'http://retinajs.com/' ),
        'rickshaw' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/rickshaw/1.1.0/rickshaw.min.js',
            'http://code.shutterstock.com/rickshaw/' ),
        'sammy' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/sammy.js/0.7.1/sammy.min.js',
            'http://sammyjs.org/' ),
        'script' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/script.js/1.3/script.min.js',
            'http://www.dustindiaz.com/scriptjs/' ),
        'scriptaculous' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/scriptaculous/1.8.3/scriptaculous.js',
            'http://script.aculo.us/' ),
        'selectivizr' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js',
            'http://selectivizr.com/' ),
        'shred' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/shred/0.7.12/shred.bundle.min.js',
            'https://github.com/spire-io/shred' ),
        'simplecartjs' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/simplecartjs/3.0.5/simplecart.min.js',
            'http://simplecartjs.org' ),
        'sizzle' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/sizzle/1.4.4/sizzle.min.js',
            'http://sizzlejs.com/' ),
        'socket.io' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/socket.io/0.9.10/socket.io.min.js',
            'http://socket.io' ),
        'sockjs-client' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/sockjs-client/0.3.2/sockjs-min.js',
            'https://github.com/sockjs/sockjs-client' ),
        'sopa' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/sopa/1.0/stopcensorship.js',
            'https://github.com/dougmartin/Stop-Censorship' ),
        'spin' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/spin.js/1.2.4/spin.min.js',
            'http://fgnass.github.com/spin.js/' ),
        'spinejs' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/spinejs/0.0.4/spine.min.js',
            'http://maccman.github.com/spine/' ),
        'stapes' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/stapes/0.5.1/stapes.min.js',
            'http://hay.github.com/stapes' ),
        'stats' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/stats.js/r11/Stats.js',
            'https://github.com/mrdoob/stats.js/' ),
        'store' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/store.js/1.1.1/store.min.js',
            'https://github.com/marcuswestin/store.js' ),
        'string_score' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/string_score/0.1.10/string_score.min.js',
            'https://github.com/joshaven/string_score' ),
        'sugar' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/sugar/1.3/sugar.min.js',
            'http://sugarjs.com/' ),
        'swfobject' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/swfobject/2.2/swfobject.js',
            'http://code.google.com/p/swfobject/' ),
        'sylvester' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/sylvester/0.1.3/sylvester.js',
            'http://sylvester.jcoglan.com/' ),
        'SyntaxHighlighter' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/scripts/shCore.js',
            'http://alexgorbatchev.com/SyntaxHighlighter' ),
        'three' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/three.js/r50/three.min.js',
            'http://mrdoob.github.com/three.js/' ),
        'tinyscrollbar' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/tinyscrollbar/1.66/jquery.tinyscrollbar.min.js',
            'http://baijs.nl/tinyscrollbar/' ),
        'twitter-bootstrap' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.1/bootstrap.min.js',
            'http://twitter.github.com/bootstrap/',
            'css' => array(
                'http://twitter.github.com/bootstrap/assets/css/bootstrap.css',
                'http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css' )),
        'twitterlib' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/twitterlib.js/1.0.8/twitterlib.min.js',
            'https://github.com/remy/twitterlib/' ),
        'underscore' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.3.3/underscore-min.js',
            'http://documentcloud.github.com/underscore/' ),
        'underscore.string' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/underscore.string/2.0.0/underscore.string.min.js',
            'http://epeli.github.com/underscore.string/' ),
        'use' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/use.js/0.2.0/use.js',
            'https://github.com/tbranyen/use.js' ),
        'visibility' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/visibility.js/0.5/visibility.min.js',
            'https://github.com/ai/visibility.js' ),
        'waypoints' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/waypoints/1.1.6/waypoints.min.js',
            'http://imakewebthings.github.com/jquery-waypoints' ),
        'webfont' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/webfont/1.0.19/webfont.js',
            'http://code.google.com/apis/webfonts/docs/webfont_loader.html' ),
        'xregexp' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/xregexp/2.0.0/xregexp-min.js',
            'http://xregexp.com/' ),
        'xuijs' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/xuijs/2.3.2/xui.min.js',
            'http://xuijs.com' ),
        'yepnope' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/yepnope/1.5.4/yepnope.min.js',
            'http://yepnopejs.com/' ),
        'yui' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/yui/3.3.0/yui-min.js',
            'http://developer.yahoo.com/yui/' ),
        'zepto' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/zepto/1.0rc1/zepto.min.js',
            'http://zeptojs.com' ),
        'zxcvbn' => array(
            'http://cdnjs.cloudflare.com/ajax/libs/zxcvbn/1.0/zxcvbn-async.js',
            'http://tech.dropbox.com/?p=165' ),
    );

    /**
     * Time Savers
     *
     */
    public function c($args)   { return $this->controller($args); }
    public function m($args)   { return $this->model($args); }
    public function mig($args) { return $this->migration($args); }
    public function v($args)   { return $this->view($args); }
    public function a($args)   { return $this->assets($args); }
    public function t($args)   { return $this->test($args); }
    public function r($args)   { return $this->resource($args); }
    public function f($args)   { return $this->fetch($args); }


    /**
     * Simply echos out some help info.
     *
     */
    public function help() { $this->run(); }
    public function run()
    {
        echo <<<EOT
\n=============GENERATOR COMMANDS=============\n        
generate:controller [name] [methods]
generate:model [name]
generate:view [name]
generate:migration [name] [field:type]
generate:test [name] [methods]
generate:assets [asset]
generate:resource [name] [methods/views]
\n=====================END====================\n
EOT;
    }


    /**
     * Generate a controller file with optional actions.
     *
     * USAGE:
     * 
     * php artisan generate:controller Admin
     * php artisan generate:controller Admin index edit
     * php artisan generate:controller Admin index index:post restful
     * 
     * @param  $args array  
     * @return string
     */
    public function controller($args)
    {
        if ( empty($args) ) {
            echo "Error: Please supply a class name, and your desired methods.\n";
            return;
        }

        // Name of the class and file
        $class_name = ucwords(array_shift($args));

        // Where will this file be stored?
        $file_path = $this->path('controllers') . strtolower("$class_name.php");

        // Begin building up the file's content
        Content::new_class($class_name . '_Controller', 'Base_Controller');

        $content = '';
        // Let's see if they added "restful" anywhere in the args.
        if ( $restful = $this->is_restful($args) ) {
            $args = array_diff($args, array('restful'));
            $content .= 'public $restful = true;';
        }

        // Now we filter through the args, and create the funcs.
        foreach($args as $method) {
            // Were params supplied? Like index:post?
            if ( strpos($method, ':') !== false ) {
                list($method, $verb) = explode(':', $method);
                $content .= Content::func("{$verb}_{$method}");
            } else {
                $action = $restful ? 'get' : 'action';

                $content .= Content::func("{$action}_{$method}");
            }
        }

        // Add methods/actions to class.
        Content::add_after('{', $content);

        // Prettify
        $this->prettify();

        // Create the file
        $this->write_to_file($file_path);
    }


    /**
     * Generate a model file + boilerplate. (To be expanded.)
     *
     * USAGE
     *
     * php artisan generate:model User
     *
     * @param  $args array  
     * @return string
     */
    public function model($args)
    {
        // Name of the class and file
        $class_name = is_array($args) ? ucwords($args[0]) : ucwords($args);

        $file_path = $this->path('models') . strtolower("$class_name.php");

        // Begin building up the file's content
        Content::new_class($class_name, 'Eloquent' );
        $this->prettify();

        // Create the file
        $this->write_to_file($file_path);
    }


    /**
     * Generate a migration file + schema
     *
     * INSTRUCTIONS:
     * - Separate each word with an underscore
     * - Name your migrations according to what you're doing
     * - Try to use the `table` keyword, to hint at the table name: create_users_table
     * - Use the `add`, `create`, `update` and `delete` keywords, according to your needs.
     * - For each field, specify its name and type: id:integer, or body:text
     * - You may also specify additional options, like: age:integer:nullable, or email:string:unique
     *
     *
     * USAGE OPTIONS
     *
     * php artisan generate:migration create_users_table
     * php artisan generate:migration create_users_table id:integer email:string:unique age:integer:nullable
     * php artisan generate:migration add_user_id_to_posts_table user_id:integer
     * php artisan generate:migration delete_active_from_users_table active:boolean
     *
     * @param  $args array  
     * @return string
     */
    public function migration($args)
    {
        if ( empty($args) ) {
            echo "Error: Please provide a name for your migration.\n";
            return;
        }

        $class_name = array_shift($args);

        // Determine what the table name should be.
        $table_name = $this->parse_table_name($class_name);

        // Capitalize where necessary: a_simple_string => A_Simple_String
        $class_name = implode('_', array_map('ucwords', explode('_', $class_name)));

        // Let's create the path to where the migration will be stored.
        $file_path = $this->path('migrations') . date('Y_m_d_His') . strtolower("_$class_name.php");

        $this->generate_migration($class_name, $table_name, $args);

        return $this->write_to_file($file_path);
    }


    /**
     * Create any number of views
     *
     * USAGE:
     *
     * php artisan generate:view home show
     * php artisan generate:view home.index home.show
     *
     * @param $args array
     * @return void
     */
    public function view($paths)
    {
        if ( empty($paths) ) {
            echo "Warning: no views were specified. Add some!\n";
            return;
        }

        foreach( $paths as $path ) {
            $file_path = $this->path('views') . str_replace('.', '/', $path) . '.blade.php';
            self::$content = "This is the $file_path view";
            $this->write_to_file($file_path);
        }
    }


    /**
     * Create assets in the public directory
     *
     * USAGE:
     * php artisan generate:assets style1.css some_module.js
     * 
     * @param  $assets array
     * @return void
     */
    public function assets($assets)
    {
        if( empty($assets) ) {
            echo "Please specify the assets that you would like to create.";
            return;
        }

        foreach( $assets as $asset ) {
            // What type of file? CSS, JS?
            $ext = File::extension($asset);

            if( !$ext ) {
                // Hmm - not sure what to do.
                echo "Warning: Could not determine file type. Please specify an extension.";
                continue;
            }

            // Set the path, dependent upon the file type.
            switch ($ext) {
                case 'js':
                    $path = self::$js_dir . $asset;
                    break;

                case 'coffee':
                    $path = self::$coffee_dir . $asset;
                    break;

                case 'scss':
                case 'sass':
                    $path = self::$sass_dir . $asset;
                    break;

                case 'less':
                    $path = self::$less_dir . $asset;
                    break;

                case 'css':
                default:
                    $path = self::$css_dir . $asset;
                    break;
            }

            $this->write_to_file(path('public') . $path, '');
        }
    }


    /**
     * Create PHPUnit test classes with optional methods
     *
     * USAGE:
     *
     * php artisan generate:test membership
     * php artisan generate:test membership can_disable_user can_reset_user_password
     *
     * @param $args array  
     * @return void
     */
    public function test($args)
    {
        if ( empty($args) ) {
            echo "Please specify a name for your test class.\n";
            return;
        }

        $class_name = ucwords(array_shift($args));

        $file_path = $this->path('tests') . strtolower("{$class_name}.test.php");

        // Begin building up the file's content
        Content::new_class($class_name . '_Test', 'PHPUnit_Framework_TestCase');

        // add the functions
        $tests = '';
        foreach($args as $test) {
            // make lower case
            $tests .= Content::func("test_{$test}");
        }

        // add funcs to class
        Content::add_after('{', $tests);

        // Create the file
        $this->write_to_file($file_path, $this->prettify());
    }


    /**
     * Creates the content for the migration file.
     *
     * @param  $class_name string
     * @param  $table_name string
     * @param  $args array
     * @return void
     */
    protected function generate_migration($class_name, $table_name, $args)
    {
        // Figure out what type of event is occuring. Create, Delete, Add?
        list($table_action, $table_event) = $this->parse_action_type($class_name);

        // Now, we begin creating the contents of the file.
        Content::new_class($class_name);

        /* The Migration Up Function */
        $up = $this->migration_up($table_event, $table_action, $table_name, $args);
       
        /* The Migration Down Function */
        $down = $this->migration_down($table_event, $table_action, $table_name, $args);

        // Add both the up and down function to the migration class.
        Content::add_after('{', $up . $down);

        return $this->prettify();
    }


    protected function migration_up($table_event, $table_action, $table_name, $args)
    {
        $up = Content::func('up');

        // Insert a new schema function into the up function.
        $up = $this->add_after('{', Content::schema($table_action, $table_name), $up);

        // Create the field rules for for the schema
        if ( $table_event === 'create' ) {
            $fields = $this->set_column('increments', 'id') . ';';
            $fields .= $this->add_columns($args);
            $fields .= $this->set_column('timestamps', null) . ';';
        }

        else if ( $table_event === 'delete' ) {
            $fields = $this->drop_columns($args);
        }

        else if ( $table_event === 'add' || $table_event === 'update' ) {
            $fields = $this->add_columns($args);
        }

        // Insert the fields into the schema function
        return $this->add_after('function($table) {', $fields, $up);
    }


    protected function migration_down($table_event, $table_action, $table_name, $args)
    {
        $down = Content::func('down');

        if ( $table_event === 'create' ) {
           $schema = Content::schema('drop', $table_name, false);

           // Add drop schema into down function
           $down = $this->add_after('{', $schema, $down);
        } else {
            // for delete, add, and update
            $schema = Content::schema('table', $table_name);
        }

        if ( $table_event === 'delete' ) {
            $fields = $this->add_columns($args);

            // add fields to schema
            $schema = $this->add_after('function($table) {', $fields, $schema);
            
            // add schema to down function
            $down = $this->add_after('{', $schema, $down);
        }

        else if ( $table_event === 'add' ) {
            $fields = $this->drop_columns($args);

            // add fields to schema
            $schema = $this->add_after('function($table) {', $fields, $schema);

            // add schema to down function
            $down = $this->add_after('{', $schema, $down);

        }

        else if ( $table_event === 'update' ) {
            // add schema to down function
            $down = $this->add_after('{', $schema, $down);
        }

        return $down;
    }


    /**
     * Generate resource (model, controller, and views)
     *
     * @param $args array  
     * @return void
     */
    public function resource($args)
    {
        // Pluralize controller name
        if ( !preg_match('/admin|config/', $args[0]) ) {
            $args[0] = Str::plural($args[0]);
        }

        $this->controller($args);

        // Singular for everything else
        $resource_name = Str::singular(array_shift($args));

        if ( $this->is_restful($args) ) {
            // Remove that restful item from the array. No longer needed.
            $args = array_diff($args, array('restful'));
            $args = $this->determine_views($args);
        }

        // Let's take any supplied view names, and set them
        // in the resource name's directory.
        $views = array_map(function($val) use($resource_name) {
            return "{$resource_name}.{$val}";
        }, $args);

        $this->view($views);
        
        $this->model($resource_name);
    }

    /**
     * Fetch remote libraries
     *
     * @param $args array  
     * @return void
     */
    public function fetch($args)
    {
        if ( !isset( $args[0] ) ) {
            return;
        }
        if ( $args[0] === 'list' ) {
            $max = max(array_map('strlen',array_keys(self::$libraries)));
            foreach( self::$libraries as $lib => $info ) {
                echo str_pad($lib, $max+2).' - '.$info[1]."\n";
            }
            return;
        }
        if ( array_key_exists($args[0], self::$libraries) ) {
            echo 'Installing: '.$args[0]."\n";
            if ( ( self::$content = @file_get_contents(self::$libraries[$args[0]][0]) ) ) {
                if ( $this->write_to_file(path('public').self::$js_vendors_dir.basename(self::$libraries[$args[0]][0])) ) {
                    if ( isset(self::$libraries[$args[0]]['css']) && count( self::$libraries[$args[0]]['css'] ) > 0 
                    && ( !isset( $args[1] ) || $args[1] !== 'nocss' ) ) {
                        foreach(self::$libraries[$args[0]]['css'] as $file) {
                            if ( ( self::$content = @file_get_contents($file) ) ) {
                                $this->write_to_file(path('public').self::$css_vendors_dir.basename($file));
                            }
                        }
                    }
                    echo "Installation complete.\n";
                }
            }
        }
        return;
    }


    /**
     * Figure out what the name of the table is.
     *
     * Fetch the value that comes right before "_table"
     * Or try to grab the very last word that comes after "_" - create_*users*
     * If all else fails, return a generic "TABLE", to be filled in by the user.
     *
     * @param  $class_name string  
     * @return string
     */
    protected function parse_table_name($class_name)
    {
        // Try to figure out the table name
        // We'll use the word that comes immediately before "_table"
        // create_users_table => users
        preg_match('/([a-zA-Z]+)_table/', $class_name, $matches);

        if ( empty($matches) ) {
            // Or, if the user doesn't write "table", we'll just use
            // the text at the end of the string
            // create_users => users
            preg_match('/_([a-zA-Z]+)$/', $class_name, $matches);
        }

        // Hmm - I'm stumped. Just use a generic name.
        return empty($matches)
            ? "TABLE"
            : $matches[1];
    }


    /**
     * Write the contents to the specified file
     *
     * @param  $file_path string
     * @param $content string
     * @param $type string [model|controller|migration]  
     * @return void
     */
    protected function write_to_file($file_path,  $success = '')
    {
        $success = $success ?: "Create: $file_path.\n";

        if ( File::exists($file_path) ) {
            // we don't want to overwrite it
            echo "Warning: File already exists at $file_path\n";
            return;
        }

        // As a precaution, let's see if we need to make the folder.
        File::mkdir(dirname($file_path));

        if ( File::put($file_path, self::$content) !== false ) {
            echo $success;
            return true;
        } else {
            echo "Whoops - something...erghh...went wrong!\n";
        }
        return false;
    }


    /**
     * Try to determine what type of table action should occur.
     * Add, Create, Delete??
     *
     * @param  $class_name string  
     * @return aray
     */
    protected function parse_action_type($class_name)
    {
         // What type of action? Creating a table? Adding a column? Deleting?
        if ( preg_match('/delete|update|add(?=_)/i', $class_name, $matches) ) {
            $table_action = 'table';
            $table_event = strtolower($matches[0]);
        } else {
            $table_action = $table_event = 'create';
        }

        return array($table_action, $table_event);
    }


    protected function increment()
    {
        return "\$table->increments('id')";
    }


    protected function set_column($type, $field = '')
    {
        return empty($field)
            ? "\$table->$type()"
            : "\$table->$type('$field')";
    }


    protected function add_option($option)
    {
        return "->{$option}()";
    }


    /**
     * Add columns
     *
     * Filters through the provided args, and builds up the schema text.
     *
     * @param  $args array  
     * @return string
     */
    protected function add_columns($args)
    {
        $content = '';

        // Build up the schema
        foreach( $args as $arg ) {
            // Like age, integer, and nullable
            @list($field, $type, $setting) = explode(':', $arg);

            if ( !$type ) {
                echo "There was an error in your formatting. Please try again. Did you specify both a field and data type for each? age:int\n";
                die();
            }

            // Primary key check
            if ( $field === 'id' and $type === 'integer' ) {
                $rule = $this->increment();
            } else {
                $rule = $this->set_column($type, $field);

                if ( !empty($setting) ) {
                    $rule .= $this->add_option($setting);
                }
            }

            $content .= $rule . ";";
        }

        return $content;
    }


    /**
     * Drop Columns
     *
     * Filters through the args and applies the "drop_column" syntax
     *
     * @param $args array  
     * @return string
     */
    protected function drop_columns($args)
    {
        $fields = array_map(function($val) {
            $bits = explode(':', $val);
            return "'$bits[0]'";
        }, $args);
       
        if ( count($fields) === 1 ) {
            return "\$table->drop_column($fields[0]);";
        } else {
            return "\$table->drop_column(array(" . implode(', ', $fields) . "));";
        }
    }

    public function path($dir)
    {
        return path('app') . "$dir/";
    }


    /**
     * Crazy sloppy prettify. TODO - Cleanup
     *
     * @param  $content string  
     * @return string
     */
    protected function prettify()
    {
        $content = self::$content;

        $content = str_replace('<?php ', "<?php\n\n", $content);
        $content = str_replace('{}', "\n{\n\n}", $content);
        $content = str_replace('public', "\n\n\tpublic", $content);
        $content = str_replace("() \n{\n\n}", "()\n\t{\n\n\t}", $content);
        $content = str_replace('}}', "}\n\n}", $content);

        // Migration-Specific
        $content = preg_replace('/ ?Schema::/', "\n\t\tSchema::", $content);
        $content = preg_replace('/\$table(?!\))/', "\n\t\t\t\$table", $content);
        $content = str_replace('});}', "\n\t\t});\n\t}", $content);
        $content = str_replace(');}', ");\n\t}", $content);
        $content = str_replace("() {", "()\n\t{", $content);

        self::$content = $content;
    }


    public function add_after($where, $to_add, $content)
    {
        return str_replace($where, $where . $to_add, $content);
    }


    protected function is_restful($args)
    {
        $restful_pos = array_search('restful', $args);
        return $restful_pos !== false;
    }


    protected function determine_views($args)
    {
        // Separate index:post, and remove any non-GET views.
        array_walk($args, function(&$arg, $index) use(&$args) {
            // method, optional verb
            $bits = explode(':', $arg);
            $arg = $bits[0];

            if ( isset($bits[1]) && $bits[1] !== 'get' ) {
                // then we shouldn't create a view for it.
                unset($args[$index]);
            }
        });

        return $args;
    }
}

class Content {
    public static function new_class($name, $extends_class = null)
    {
        $content = "<?php class $name";
        if ( !empty($extends_class) ) {
            $content .= " extends $extends_class";
        }

        $content .= ' {}';

        Generate_Task::$content = $content;
    }

    public static function func($func_name)
    {
        return "public function {$func_name}() {}";
    }

    public static function schema($table_action, $table_name, $cb = true)
    {
        $content = "Schema::$table_action('$table_name'";

        return $cb
            ? $content . ', function($table) {});'
            : $content . ');';
    }

    public static function add_after($where, $to_add)
    {
        Generate_Task::$content = str_replace($where, $where . $to_add, Generate_Task::$content);

    }
}