@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<style>
    .myaccordion {
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.1);
    }

    .myaccordion .card,
    .myaccordion .card:last-child .card-header {
        border: none;
    }

    .myaccordion .card-header {
        border-bottom-color: #EDEFF0;
        background: transparent;
    }

    /****************************************************************
 *
 * CSS Percentage Circle
 * Author: Andre Firchow
 *
*****************************************************************/
    .rect-auto,
    .c100.p51 .slice,
    .c100.p52 .slice,
    .c100.p53 .slice,
    .c100.p54 .slice,
    .c100.p55 .slice,
    .c100.p56 .slice,
    .c100.p57 .slice,
    .c100.p58 .slice,
    .c100.p59 .slice,
    .c100.p60 .slice,
    .c100.p61 .slice,
    .c100.p62 .slice,
    .c100.p63 .slice,
    .c100.p64 .slice,
    .c100.p65 .slice,
    .c100.p66 .slice,
    .c100.p67 .slice,
    .c100.p68 .slice,
    .c100.p69 .slice,
    .c100.p70 .slice,
    .c100.p71 .slice,
    .c100.p72 .slice,
    .c100.p73 .slice,
    .c100.p74 .slice,
    .c100.p75 .slice,
    .c100.p76 .slice,
    .c100.p77 .slice,
    .c100.p78 .slice,
    .c100.p79 .slice,
    .c100.p80 .slice,
    .c100.p81 .slice,
    .c100.p82 .slice,
    .c100.p83 .slice,
    .c100.p84 .slice,
    .c100.p85 .slice,
    .c100.p86 .slice,
    .c100.p87 .slice,
    .c100.p88 .slice,
    .c100.p89 .slice,
    .c100.p90 .slice,
    .c100.p91 .slice,
    .c100.p92 .slice,
    .c100.p93 .slice,
    .c100.p94 .slice,
    .c100.p95 .slice,
    .c100.p96 .slice,
    .c100.p97 .slice,
    .c100.p98 .slice,
    .c100.p99 .slice,
    .c100.p100 .slice {
        clip: rect(auto, auto, auto, auto);
    }

    .pie,
    .c100 .bar,
    .c100.p51 .fill,
    .c100.p52 .fill,
    .c100.p53 .fill,
    .c100.p54 .fill,
    .c100.p55 .fill,
    .c100.p56 .fill,
    .c100.p57 .fill,
    .c100.p58 .fill,
    .c100.p59 .fill,
    .c100.p60 .fill,
    .c100.p61 .fill,
    .c100.p62 .fill,
    .c100.p63 .fill,
    .c100.p64 .fill,
    .c100.p65 .fill,
    .c100.p66 .fill,
    .c100.p67 .fill,
    .c100.p68 .fill,
    .c100.p69 .fill,
    .c100.p70 .fill,
    .c100.p71 .fill,
    .c100.p72 .fill,
    .c100.p73 .fill,
    .c100.p74 .fill,
    .c100.p75 .fill,
    .c100.p76 .fill,
    .c100.p77 .fill,
    .c100.p78 .fill,
    .c100.p79 .fill,
    .c100.p80 .fill,
    .c100.p81 .fill,
    .c100.p82 .fill,
    .c100.p83 .fill,
    .c100.p84 .fill,
    .c100.p85 .fill,
    .c100.p86 .fill,
    .c100.p87 .fill,
    .c100.p88 .fill,
    .c100.p89 .fill,
    .c100.p90 .fill,
    .c100.p91 .fill,
    .c100.p92 .fill,
    .c100.p93 .fill,
    .c100.p94 .fill,
    .c100.p95 .fill,
    .c100.p96 .fill,
    .c100.p97 .fill,
    .c100.p98 .fill,
    .c100.p99 .fill,
    .c100.p100 .fill {
        position: absolute;
        border: 0.08em solid #307bbb;
        width: 0.84em;
        height: 0.84em;
        clip: rect(0em, 0.5em, 1em, 0em);
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
        border-radius: 50%;
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    .pie-fill,
    .c100.p51 .bar:after,
    .c100.p51 .fill,
    .c100.p52 .bar:after,
    .c100.p52 .fill,
    .c100.p53 .bar:after,
    .c100.p53 .fill,
    .c100.p54 .bar:after,
    .c100.p54 .fill,
    .c100.p55 .bar:after,
    .c100.p55 .fill,
    .c100.p56 .bar:after,
    .c100.p56 .fill,
    .c100.p57 .bar:after,
    .c100.p57 .fill,
    .c100.p58 .bar:after,
    .c100.p58 .fill,
    .c100.p59 .bar:after,
    .c100.p59 .fill,
    .c100.p60 .bar:after,
    .c100.p60 .fill,
    .c100.p61 .bar:after,
    .c100.p61 .fill,
    .c100.p62 .bar:after,
    .c100.p62 .fill,
    .c100.p63 .bar:after,
    .c100.p63 .fill,
    .c100.p64 .bar:after,
    .c100.p64 .fill,
    .c100.p65 .bar:after,
    .c100.p65 .fill,
    .c100.p66 .bar:after,
    .c100.p66 .fill,
    .c100.p67 .bar:after,
    .c100.p67 .fill,
    .c100.p68 .bar:after,
    .c100.p68 .fill,
    .c100.p69 .bar:after,
    .c100.p69 .fill,
    .c100.p70 .bar:after,
    .c100.p70 .fill,
    .c100.p71 .bar:after,
    .c100.p71 .fill,
    .c100.p72 .bar:after,
    .c100.p72 .fill,
    .c100.p73 .bar:after,
    .c100.p73 .fill,
    .c100.p74 .bar:after,
    .c100.p74 .fill,
    .c100.p75 .bar:after,
    .c100.p75 .fill,
    .c100.p76 .bar:after,
    .c100.p76 .fill,
    .c100.p77 .bar:after,
    .c100.p77 .fill,
    .c100.p78 .bar:after,
    .c100.p78 .fill,
    .c100.p79 .bar:after,
    .c100.p79 .fill,
    .c100.p80 .bar:after,
    .c100.p80 .fill,
    .c100.p81 .bar:after,
    .c100.p81 .fill,
    .c100.p82 .bar:after,
    .c100.p82 .fill,
    .c100.p83 .bar:after,
    .c100.p83 .fill,
    .c100.p84 .bar:after,
    .c100.p84 .fill,
    .c100.p85 .bar:after,
    .c100.p85 .fill,
    .c100.p86 .bar:after,
    .c100.p86 .fill,
    .c100.p87 .bar:after,
    .c100.p87 .fill,
    .c100.p88 .bar:after,
    .c100.p88 .fill,
    .c100.p89 .bar:after,
    .c100.p89 .fill,
    .c100.p90 .bar:after,
    .c100.p90 .fill,
    .c100.p91 .bar:after,
    .c100.p91 .fill,
    .c100.p92 .bar:after,
    .c100.p92 .fill,
    .c100.p93 .bar:after,
    .c100.p93 .fill,
    .c100.p94 .bar:after,
    .c100.p94 .fill,
    .c100.p95 .bar:after,
    .c100.p95 .fill,
    .c100.p96 .bar:after,
    .c100.p96 .fill,
    .c100.p97 .bar:after,
    .c100.p97 .fill,
    .c100.p98 .bar:after,
    .c100.p98 .fill,
    .c100.p99 .bar:after,
    .c100.p99 .fill,
    .c100.p100 .bar:after,
    .c100.p100 .fill {
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .c100 {
        position: relative;
        font-size: 120px;
        width: 1em;
        height: 1em;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
        border-radius: 50%;
        float: left;
        margin: 0 0.1em 0.1em 0;
        background-color: #cccccc;
    }

    .c100 *,
    .c100 *:before,
    .c100 *:after {
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
    }

    .c100.center {
        float: none;
        margin: 0 auto;
    }

    .c100.big {
        font-size: 240px;
    }

    .c100.small {
        font-size: 80px;
    }

    .c100>span {
        position: absolute;
        width: 100%;
        z-index: 1;
        left: 0;
        top: 0;
        width: 5em;
        line-height: 5em;
        font-size: 0.2em;
        color: #cccccc;
        display: block;
        text-align: center;
        white-space: nowrap;
        -webkit-transition-property: all;
        -moz-transition-property: all;
        -o-transition-property: all;
        transition-property: all;
        -webkit-transition-duration: 0.2s;
        -moz-transition-duration: 0.2s;
        -o-transition-duration: 0.2s;
        transition-duration: 0.2s;
        -webkit-transition-timing-function: ease-out;
        -moz-transition-timing-function: ease-out;
        -o-transition-timing-function: ease-out;
        transition-timing-function: ease-out;
    }

    .c100:after {
        position: absolute;
        top: 0.08em;
        left: 0.08em;
        display: block;
        content: " ";
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
        border-radius: 50%;
        background-color: whitesmoke;
        width: 0.84em;
        height: 0.84em;
        -webkit-transition-property: all;
        -moz-transition-property: all;
        -o-transition-property: all;
        transition-property: all;
        -webkit-transition-duration: 0.2s;
        -moz-transition-duration: 0.2s;
        -o-transition-duration: 0.2s;
        transition-duration: 0.2s;
        -webkit-transition-timing-function: ease-in;
        -moz-transition-timing-function: ease-in;
        -o-transition-timing-function: ease-in;
        transition-timing-function: ease-in;
    }

    .c100 .slice {
        position: absolute;
        width: 1em;
        height: 1em;
        clip: rect(0em, 1em, 1em, 0.5em);
    }

    .c100.p1 .bar {
        -webkit-transform: rotate(3.6deg);
        -moz-transform: rotate(3.6deg);
        -ms-transform: rotate(3.6deg);
        -o-transform: rotate(3.6deg);
        transform: rotate(3.6deg);
    }

    .c100.p2 .bar {
        -webkit-transform: rotate(7.2deg);
        -moz-transform: rotate(7.2deg);
        -ms-transform: rotate(7.2deg);
        -o-transform: rotate(7.2deg);
        transform: rotate(7.2deg);
    }

    .c100.p3 .bar {
        -webkit-transform: rotate(10.8deg);
        -moz-transform: rotate(10.8deg);
        -ms-transform: rotate(10.8deg);
        -o-transform: rotate(10.8deg);
        transform: rotate(10.8deg);
    }

    .c100.p4 .bar {
        -webkit-transform: rotate(14.4deg);
        -moz-transform: rotate(14.4deg);
        -ms-transform: rotate(14.4deg);
        -o-transform: rotate(14.4deg);
        transform: rotate(14.4deg);
    }

    .c100.p5 .bar {
        -webkit-transform: rotate(18deg);
        -moz-transform: rotate(18deg);
        -ms-transform: rotate(18deg);
        -o-transform: rotate(18deg);
        transform: rotate(18deg);
    }

    .c100.p6 .bar {
        -webkit-transform: rotate(21.6deg);
        -moz-transform: rotate(21.6deg);
        -ms-transform: rotate(21.6deg);
        -o-transform: rotate(21.6deg);
        transform: rotate(21.6deg);
    }

    .c100.p7 .bar {
        -webkit-transform: rotate(25.2deg);
        -moz-transform: rotate(25.2deg);
        -ms-transform: rotate(25.2deg);
        -o-transform: rotate(25.2deg);
        transform: rotate(25.2deg);
    }

    .c100.p8 .bar {
        -webkit-transform: rotate(28.8deg);
        -moz-transform: rotate(28.8deg);
        -ms-transform: rotate(28.8deg);
        -o-transform: rotate(28.8deg);
        transform: rotate(28.8deg);
    }

    .c100.p9 .bar {
        -webkit-transform: rotate(32.4deg);
        -moz-transform: rotate(32.4deg);
        -ms-transform: rotate(32.4deg);
        -o-transform: rotate(32.4deg);
        transform: rotate(32.4deg);
    }

    .c100.p10 .bar {
        -webkit-transform: rotate(36deg);
        -moz-transform: rotate(36deg);
        -ms-transform: rotate(36deg);
        -o-transform: rotate(36deg);
        transform: rotate(36deg);
    }

    .c100.p11 .bar {
        -webkit-transform: rotate(39.6deg);
        -moz-transform: rotate(39.6deg);
        -ms-transform: rotate(39.6deg);
        -o-transform: rotate(39.6deg);
        transform: rotate(39.6deg);
    }

    .c100.p12 .bar {
        -webkit-transform: rotate(43.2deg);
        -moz-transform: rotate(43.2deg);
        -ms-transform: rotate(43.2deg);
        -o-transform: rotate(43.2deg);
        transform: rotate(43.2deg);
    }

    .c100.p13 .bar {
        -webkit-transform: rotate(46.8deg);
        -moz-transform: rotate(46.8deg);
        -ms-transform: rotate(46.8deg);
        -o-transform: rotate(46.8deg);
        transform: rotate(46.8deg);
    }

    .c100.p14 .bar {
        -webkit-transform: rotate(50.4deg);
        -moz-transform: rotate(50.4deg);
        -ms-transform: rotate(50.4deg);
        -o-transform: rotate(50.4deg);
        transform: rotate(50.4deg);
    }

    .c100.p15 .bar {
        -webkit-transform: rotate(54deg);
        -moz-transform: rotate(54deg);
        -ms-transform: rotate(54deg);
        -o-transform: rotate(54deg);
        transform: rotate(54deg);
    }

    .c100.p16 .bar {
        -webkit-transform: rotate(57.6deg);
        -moz-transform: rotate(57.6deg);
        -ms-transform: rotate(57.6deg);
        -o-transform: rotate(57.6deg);
        transform: rotate(57.6deg);
    }

    .c100.p17 .bar {
        -webkit-transform: rotate(61.2deg);
        -moz-transform: rotate(61.2deg);
        -ms-transform: rotate(61.2deg);
        -o-transform: rotate(61.2deg);
        transform: rotate(61.2deg);
    }

    .c100.p18 .bar {
        -webkit-transform: rotate(64.8deg);
        -moz-transform: rotate(64.8deg);
        -ms-transform: rotate(64.8deg);
        -o-transform: rotate(64.8deg);
        transform: rotate(64.8deg);
    }

    .c100.p19 .bar {
        -webkit-transform: rotate(68.4deg);
        -moz-transform: rotate(68.4deg);
        -ms-transform: rotate(68.4deg);
        -o-transform: rotate(68.4deg);
        transform: rotate(68.4deg);
    }

    .c100.p20 .bar {
        -webkit-transform: rotate(72deg);
        -moz-transform: rotate(72deg);
        -ms-transform: rotate(72deg);
        -o-transform: rotate(72deg);
        transform: rotate(72deg);
    }

    .c100.p21 .bar {
        -webkit-transform: rotate(75.6deg);
        -moz-transform: rotate(75.6deg);
        -ms-transform: rotate(75.6deg);
        -o-transform: rotate(75.6deg);
        transform: rotate(75.6deg);
    }

    .c100.p22 .bar {
        -webkit-transform: rotate(79.2deg);
        -moz-transform: rotate(79.2deg);
        -ms-transform: rotate(79.2deg);
        -o-transform: rotate(79.2deg);
        transform: rotate(79.2deg);
    }

    .c100.p23 .bar {
        -webkit-transform: rotate(82.8deg);
        -moz-transform: rotate(82.8deg);
        -ms-transform: rotate(82.8deg);
        -o-transform: rotate(82.8deg);
        transform: rotate(82.8deg);
    }

    .c100.p24 .bar {
        -webkit-transform: rotate(86.4deg);
        -moz-transform: rotate(86.4deg);
        -ms-transform: rotate(86.4deg);
        -o-transform: rotate(86.4deg);
        transform: rotate(86.4deg);
    }

    .c100.p25 .bar {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .c100.p26 .bar {
        -webkit-transform: rotate(93.6deg);
        -moz-transform: rotate(93.6deg);
        -ms-transform: rotate(93.6deg);
        -o-transform: rotate(93.6deg);
        transform: rotate(93.6deg);
    }

    .c100.p27 .bar {
        -webkit-transform: rotate(97.2deg);
        -moz-transform: rotate(97.2deg);
        -ms-transform: rotate(97.2deg);
        -o-transform: rotate(97.2deg);
        transform: rotate(97.2deg);
    }

    .c100.p28 .bar {
        -webkit-transform: rotate(100.8deg);
        -moz-transform: rotate(100.8deg);
        -ms-transform: rotate(100.8deg);
        -o-transform: rotate(100.8deg);
        transform: rotate(100.8deg);
    }

    .c100.p29 .bar {
        -webkit-transform: rotate(104.4deg);
        -moz-transform: rotate(104.4deg);
        -ms-transform: rotate(104.4deg);
        -o-transform: rotate(104.4deg);
        transform: rotate(104.4deg);
    }

    .c100.p30 .bar {
        -webkit-transform: rotate(108deg);
        -moz-transform: rotate(108deg);
        -ms-transform: rotate(108deg);
        -o-transform: rotate(108deg);
        transform: rotate(108deg);
    }

    .c100.p31 .bar {
        -webkit-transform: rotate(111.6deg);
        -moz-transform: rotate(111.6deg);
        -ms-transform: rotate(111.6deg);
        -o-transform: rotate(111.6deg);
        transform: rotate(111.6deg);
    }

    .c100.p32 .bar {
        -webkit-transform: rotate(115.2deg);
        -moz-transform: rotate(115.2deg);
        -ms-transform: rotate(115.2deg);
        -o-transform: rotate(115.2deg);
        transform: rotate(115.2deg);
    }

    .c100.p33 .bar {
        -webkit-transform: rotate(118.8deg);
        -moz-transform: rotate(118.8deg);
        -ms-transform: rotate(118.8deg);
        -o-transform: rotate(118.8deg);
        transform: rotate(118.8deg);
    }

    .c100.p34 .bar {
        -webkit-transform: rotate(122.4deg);
        -moz-transform: rotate(122.4deg);
        -ms-transform: rotate(122.4deg);
        -o-transform: rotate(122.4deg);
        transform: rotate(122.4deg);
    }

    .c100.p35 .bar {
        -webkit-transform: rotate(126deg);
        -moz-transform: rotate(126deg);
        -ms-transform: rotate(126deg);
        -o-transform: rotate(126deg);
        transform: rotate(126deg);
    }

    .c100.p36 .bar {
        -webkit-transform: rotate(129.6deg);
        -moz-transform: rotate(129.6deg);
        -ms-transform: rotate(129.6deg);
        -o-transform: rotate(129.6deg);
        transform: rotate(129.6deg);
    }

    .c100.p37 .bar {
        -webkit-transform: rotate(133.2deg);
        -moz-transform: rotate(133.2deg);
        -ms-transform: rotate(133.2deg);
        -o-transform: rotate(133.2deg);
        transform: rotate(133.2deg);
    }

    .c100.p38 .bar {
        -webkit-transform: rotate(136.8deg);
        -moz-transform: rotate(136.8deg);
        -ms-transform: rotate(136.8deg);
        -o-transform: rotate(136.8deg);
        transform: rotate(136.8deg);
    }

    .c100.p39 .bar {
        -webkit-transform: rotate(140.4deg);
        -moz-transform: rotate(140.4deg);
        -ms-transform: rotate(140.4deg);
        -o-transform: rotate(140.4deg);
        transform: rotate(140.4deg);
    }

    .c100.p40 .bar {
        -webkit-transform: rotate(144deg);
        -moz-transform: rotate(144deg);
        -ms-transform: rotate(144deg);
        -o-transform: rotate(144deg);
        transform: rotate(144deg);
    }

    .c100.p41 .bar {
        -webkit-transform: rotate(147.6deg);
        -moz-transform: rotate(147.6deg);
        -ms-transform: rotate(147.6deg);
        -o-transform: rotate(147.6deg);
        transform: rotate(147.6deg);
    }

    .c100.p42 .bar {
        -webkit-transform: rotate(151.2deg);
        -moz-transform: rotate(151.2deg);
        -ms-transform: rotate(151.2deg);
        -o-transform: rotate(151.2deg);
        transform: rotate(151.2deg);
    }

    .c100.p43 .bar {
        -webkit-transform: rotate(154.8deg);
        -moz-transform: rotate(154.8deg);
        -ms-transform: rotate(154.8deg);
        -o-transform: rotate(154.8deg);
        transform: rotate(154.8deg);
    }

    .c100.p44 .bar {
        -webkit-transform: rotate(158.4deg);
        -moz-transform: rotate(158.4deg);
        -ms-transform: rotate(158.4deg);
        -o-transform: rotate(158.4deg);
        transform: rotate(158.4deg);
    }

    .c100.p45 .bar {
        -webkit-transform: rotate(162deg);
        -moz-transform: rotate(162deg);
        -ms-transform: rotate(162deg);
        -o-transform: rotate(162deg);
        transform: rotate(162deg);
    }

    .c100.p46 .bar {
        -webkit-transform: rotate(165.6deg);
        -moz-transform: rotate(165.6deg);
        -ms-transform: rotate(165.6deg);
        -o-transform: rotate(165.6deg);
        transform: rotate(165.6deg);
    }

    .c100.p47 .bar {
        -webkit-transform: rotate(169.2deg);
        -moz-transform: rotate(169.2deg);
        -ms-transform: rotate(169.2deg);
        -o-transform: rotate(169.2deg);
        transform: rotate(169.2deg);
    }

    .c100.p48 .bar {
        -webkit-transform: rotate(172.8deg);
        -moz-transform: rotate(172.8deg);
        -ms-transform: rotate(172.8deg);
        -o-transform: rotate(172.8deg);
        transform: rotate(172.8deg);
    }

    .c100.p49 .bar {
        -webkit-transform: rotate(176.4deg);
        -moz-transform: rotate(176.4deg);
        -ms-transform: rotate(176.4deg);
        -o-transform: rotate(176.4deg);
        transform: rotate(176.4deg);
    }

    .c100.p50 .bar {
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .c100.p51 .bar {
        -webkit-transform: rotate(183.6deg);
        -moz-transform: rotate(183.6deg);
        -ms-transform: rotate(183.6deg);
        -o-transform: rotate(183.6deg);
        transform: rotate(183.6deg);
    }

    .c100.p52 .bar {
        -webkit-transform: rotate(187.2deg);
        -moz-transform: rotate(187.2deg);
        -ms-transform: rotate(187.2deg);
        -o-transform: rotate(187.2deg);
        transform: rotate(187.2deg);
    }

    .c100.p53 .bar {
        -webkit-transform: rotate(190.8deg);
        -moz-transform: rotate(190.8deg);
        -ms-transform: rotate(190.8deg);
        -o-transform: rotate(190.8deg);
        transform: rotate(190.8deg);
    }

    .c100.p54 .bar {
        -webkit-transform: rotate(194.4deg);
        -moz-transform: rotate(194.4deg);
        -ms-transform: rotate(194.4deg);
        -o-transform: rotate(194.4deg);
        transform: rotate(194.4deg);
    }

    .c100.p55 .bar {
        -webkit-transform: rotate(198deg);
        -moz-transform: rotate(198deg);
        -ms-transform: rotate(198deg);
        -o-transform: rotate(198deg);
        transform: rotate(198deg);
    }

    .c100.p56 .bar {
        -webkit-transform: rotate(201.6deg);
        -moz-transform: rotate(201.6deg);
        -ms-transform: rotate(201.6deg);
        -o-transform: rotate(201.6deg);
        transform: rotate(201.6deg);
    }

    .c100.p57 .bar {
        -webkit-transform: rotate(205.2deg);
        -moz-transform: rotate(205.2deg);
        -ms-transform: rotate(205.2deg);
        -o-transform: rotate(205.2deg);
        transform: rotate(205.2deg);
    }

    .c100.p58 .bar {
        -webkit-transform: rotate(208.8deg);
        -moz-transform: rotate(208.8deg);
        -ms-transform: rotate(208.8deg);
        -o-transform: rotate(208.8deg);
        transform: rotate(208.8deg);
    }

    .c100.p59 .bar {
        -webkit-transform: rotate(212.4deg);
        -moz-transform: rotate(212.4deg);
        -ms-transform: rotate(212.4deg);
        -o-transform: rotate(212.4deg);
        transform: rotate(212.4deg);
    }

    .c100.p60 .bar {
        -webkit-transform: rotate(216deg);
        -moz-transform: rotate(216deg);
        -ms-transform: rotate(216deg);
        -o-transform: rotate(216deg);
        transform: rotate(216deg);
    }

    .c100.p61 .bar {
        -webkit-transform: rotate(219.6deg);
        -moz-transform: rotate(219.6deg);
        -ms-transform: rotate(219.6deg);
        -o-transform: rotate(219.6deg);
        transform: rotate(219.6deg);
    }

    .c100.p62 .bar {
        -webkit-transform: rotate(223.2deg);
        -moz-transform: rotate(223.2deg);
        -ms-transform: rotate(223.2deg);
        -o-transform: rotate(223.2deg);
        transform: rotate(223.2deg);
    }

    .c100.p63 .bar {
        -webkit-transform: rotate(226.8deg);
        -moz-transform: rotate(226.8deg);
        -ms-transform: rotate(226.8deg);
        -o-transform: rotate(226.8deg);
        transform: rotate(226.8deg);
    }

    .c100.p64 .bar {
        -webkit-transform: rotate(230.4deg);
        -moz-transform: rotate(230.4deg);
        -ms-transform: rotate(230.4deg);
        -o-transform: rotate(230.4deg);
        transform: rotate(230.4deg);
    }

    .c100.p65 .bar {
        -webkit-transform: rotate(234deg);
        -moz-transform: rotate(234deg);
        -ms-transform: rotate(234deg);
        -o-transform: rotate(234deg);
        transform: rotate(234deg);
    }

    .c100.p66 .bar {
        -webkit-transform: rotate(237.6deg);
        -moz-transform: rotate(237.6deg);
        -ms-transform: rotate(237.6deg);
        -o-transform: rotate(237.6deg);
        transform: rotate(237.6deg);
    }

    .c100.p67 .bar {
        -webkit-transform: rotate(241.2deg);
        -moz-transform: rotate(241.2deg);
        -ms-transform: rotate(241.2deg);
        -o-transform: rotate(241.2deg);
        transform: rotate(241.2deg);
    }

    .c100.p68 .bar {
        -webkit-transform: rotate(244.8deg);
        -moz-transform: rotate(244.8deg);
        -ms-transform: rotate(244.8deg);
        -o-transform: rotate(244.8deg);
        transform: rotate(244.8deg);
    }

    .c100.p69 .bar {
        -webkit-transform: rotate(248.4deg);
        -moz-transform: rotate(248.4deg);
        -ms-transform: rotate(248.4deg);
        -o-transform: rotate(248.4deg);
        transform: rotate(248.4deg);
    }

    .c100.p70 .bar {
        -webkit-transform: rotate(252deg);
        -moz-transform: rotate(252deg);
        -ms-transform: rotate(252deg);
        -o-transform: rotate(252deg);
        transform: rotate(252deg);
    }

    .c100.p71 .bar {
        -webkit-transform: rotate(255.6deg);
        -moz-transform: rotate(255.6deg);
        -ms-transform: rotate(255.6deg);
        -o-transform: rotate(255.6deg);
        transform: rotate(255.6deg);
    }

    .c100.p72 .bar {
        -webkit-transform: rotate(259.2deg);
        -moz-transform: rotate(259.2deg);
        -ms-transform: rotate(259.2deg);
        -o-transform: rotate(259.2deg);
        transform: rotate(259.2deg);
    }

    .c100.p73 .bar {
        -webkit-transform: rotate(262.8deg);
        -moz-transform: rotate(262.8deg);
        -ms-transform: rotate(262.8deg);
        -o-transform: rotate(262.8deg);
        transform: rotate(262.8deg);
    }

    .c100.p74 .bar {
        -webkit-transform: rotate(266.4deg);
        -moz-transform: rotate(266.4deg);
        -ms-transform: rotate(266.4deg);
        -o-transform: rotate(266.4deg);
        transform: rotate(266.4deg);
    }

    .c100.p75 .bar {
        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        transform: rotate(270deg);
    }

    .c100.p76 .bar {
        -webkit-transform: rotate(273.6deg);
        -moz-transform: rotate(273.6deg);
        -ms-transform: rotate(273.6deg);
        -o-transform: rotate(273.6deg);
        transform: rotate(273.6deg);
    }

    .c100.p77 .bar {
        -webkit-transform: rotate(277.2deg);
        -moz-transform: rotate(277.2deg);
        -ms-transform: rotate(277.2deg);
        -o-transform: rotate(277.2deg);
        transform: rotate(277.2deg);
    }

    .c100.p78 .bar {
        -webkit-transform: rotate(280.8deg);
        -moz-transform: rotate(280.8deg);
        -ms-transform: rotate(280.8deg);
        -o-transform: rotate(280.8deg);
        transform: rotate(280.8deg);
    }

    .c100.p79 .bar {
        -webkit-transform: rotate(284.4deg);
        -moz-transform: rotate(284.4deg);
        -ms-transform: rotate(284.4deg);
        -o-transform: rotate(284.4deg);
        transform: rotate(284.4deg);
    }

    .c100.p80 .bar {
        -webkit-transform: rotate(288deg);
        -moz-transform: rotate(288deg);
        -ms-transform: rotate(288deg);
        -o-transform: rotate(288deg);
        transform: rotate(288deg);
    }

    .c100.p81 .bar {
        -webkit-transform: rotate(291.6deg);
        -moz-transform: rotate(291.6deg);
        -ms-transform: rotate(291.6deg);
        -o-transform: rotate(291.6deg);
        transform: rotate(291.6deg);
    }

    .c100.p82 .bar {
        -webkit-transform: rotate(295.2deg);
        -moz-transform: rotate(295.2deg);
        -ms-transform: rotate(295.2deg);
        -o-transform: rotate(295.2deg);
        transform: rotate(295.2deg);
    }

    .c100.p83 .bar {
        -webkit-transform: rotate(298.8deg);
        -moz-transform: rotate(298.8deg);
        -ms-transform: rotate(298.8deg);
        -o-transform: rotate(298.8deg);
        transform: rotate(298.8deg);
    }

    .c100.p84 .bar {
        -webkit-transform: rotate(302.4deg);
        -moz-transform: rotate(302.4deg);
        -ms-transform: rotate(302.4deg);
        -o-transform: rotate(302.4deg);
        transform: rotate(302.4deg);
    }

    .c100.p85 .bar {
        -webkit-transform: rotate(306deg);
        -moz-transform: rotate(306deg);
        -ms-transform: rotate(306deg);
        -o-transform: rotate(306deg);
        transform: rotate(306deg);
    }

    .c100.p86 .bar {
        -webkit-transform: rotate(309.6deg);
        -moz-transform: rotate(309.6deg);
        -ms-transform: rotate(309.6deg);
        -o-transform: rotate(309.6deg);
        transform: rotate(309.6deg);
    }

    .c100.p87 .bar {
        -webkit-transform: rotate(313.2deg);
        -moz-transform: rotate(313.2deg);
        -ms-transform: rotate(313.2deg);
        -o-transform: rotate(313.2deg);
        transform: rotate(313.2deg);
    }

    .c100.p88 .bar {
        -webkit-transform: rotate(316.8deg);
        -moz-transform: rotate(316.8deg);
        -ms-transform: rotate(316.8deg);
        -o-transform: rotate(316.8deg);
        transform: rotate(316.8deg);
    }

    .c100.p89 .bar {
        -webkit-transform: rotate(320.4deg);
        -moz-transform: rotate(320.4deg);
        -ms-transform: rotate(320.4deg);
        -o-transform: rotate(320.4deg);
        transform: rotate(320.4deg);
    }

    .c100.p90 .bar {
        -webkit-transform: rotate(324deg);
        -moz-transform: rotate(324deg);
        -ms-transform: rotate(324deg);
        -o-transform: rotate(324deg);
        transform: rotate(324deg);
    }

    .c100.p91 .bar {
        -webkit-transform: rotate(327.6deg);
        -moz-transform: rotate(327.6deg);
        -ms-transform: rotate(327.6deg);
        -o-transform: rotate(327.6deg);
        transform: rotate(327.6deg);
    }

    .c100.p92 .bar {
        -webkit-transform: rotate(331.2deg);
        -moz-transform: rotate(331.2deg);
        -ms-transform: rotate(331.2deg);
        -o-transform: rotate(331.2deg);
        transform: rotate(331.2deg);
    }

    .c100.p93 .bar {
        -webkit-transform: rotate(334.8deg);
        -moz-transform: rotate(334.8deg);
        -ms-transform: rotate(334.8deg);
        -o-transform: rotate(334.8deg);
        transform: rotate(334.8deg);
    }

    .c100.p94 .bar {
        -webkit-transform: rotate(338.4deg);
        -moz-transform: rotate(338.4deg);
        -ms-transform: rotate(338.4deg);
        -o-transform: rotate(338.4deg);
        transform: rotate(338.4deg);
    }

    .c100.p95 .bar {
        -webkit-transform: rotate(342deg);
        -moz-transform: rotate(342deg);
        -ms-transform: rotate(342deg);
        -o-transform: rotate(342deg);
        transform: rotate(342deg);
    }

    .c100.p96 .bar {
        -webkit-transform: rotate(345.6deg);
        -moz-transform: rotate(345.6deg);
        -ms-transform: rotate(345.6deg);
        -o-transform: rotate(345.6deg);
        transform: rotate(345.6deg);
    }

    .c100.p97 .bar {
        -webkit-transform: rotate(349.2deg);
        -moz-transform: rotate(349.2deg);
        -ms-transform: rotate(349.2deg);
        -o-transform: rotate(349.2deg);
        transform: rotate(349.2deg);
    }

    .c100.p98 .bar {
        -webkit-transform: rotate(352.8deg);
        -moz-transform: rotate(352.8deg);
        -ms-transform: rotate(352.8deg);
        -o-transform: rotate(352.8deg);
        transform: rotate(352.8deg);
    }

    .c100.p99 .bar {
        -webkit-transform: rotate(356.4deg);
        -moz-transform: rotate(356.4deg);
        -ms-transform: rotate(356.4deg);
        -o-transform: rotate(356.4deg);
        transform: rotate(356.4deg);
    }

    .c100.p100 .bar {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }

    .c100:hover {
        cursor: default;
    }

    .c100:hover>span {
        width: 3.33em;
        line-height: 3.33em;
        font-size: 0.3em;
        color: #307bbb;
    }

    .c100:hover:after {
        top: 0.04em;
        left: 0.04em;
        width: 0.92em;
        height: 0.92em;
    }

    .c100.dark {
        background-color: #777777;
    }

    .c100.dark .bar,
    .c100.dark .fill {
        border-color: #c6ff00 !important;
    }

    .c100.dark>span {
        color: #777777;
    }

    .c100.dark:after {
        background-color: #666666;
    }

    .c100.dark:hover>span {
        color: #c6ff00;
    }

    .c100.green .bar,
    .c100.green .fill {
        border-color: #4db53c !important;
    }

    .c100.green:hover>span {
        color: #4db53c;
    }

    .c100.green.dark .bar,
    .c100.green.dark .fill {
        border-color: #5fd400 !important;
    }

    .c100.green.dark:hover>span {
        color: #5fd400;
    }

    .c100.orange .bar,
    .c100.orange .fill {
        border-color: #dd9d22 !important;
    }

    .c100.orange:hover>span {
        color: #dd9d22;
    }

    .c100.orange.dark .bar,
    .c100.orange.dark .fill {
        border-color: #e08833 !important;
    }

    .c100.orange.dark:hover>span {
        color: #e08833;
    }



    .myaccordion .fa-stack {
        font-size: 18px;
    }

    .myaccordion .btn {
        width: 100%;
        font-weight: bold;
        color: #004987;
        padding: 0;
    }

    .myaccordion .btn-link:hover,
    .myaccordion .btn-link:focus {
        text-decoration: none;
    }

    .myaccordion li+li {
        margin-top: 10px;
    }

</style>

@section('content')
    <div class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="/assets/img/avatars/1.jpg"
                                        alt="User profile picture">
                                </div>
                                {{-- <?php dd($user[0]->fullname); ?> --}}
                                <h3 class="profile-username text-center">{{ $user[0]->fullname }}</h3>
                                @foreach (explode(',', $user[0]->name) as $group_name)
                                    <span class="badge badge-primary">{{ $group_name }}</span>
                                @endforeach
                                <hr>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                </ul>
                                <a href="{{ route('participants.edit', $user[0]->id) }}"
                                    class="btn btn-info btn-block"><b><i class="cil-pencil"></i> Edit</b></a>
                                <a class="btn btn-danger btn-block delete" href="javascript:void(0)" data-toggle="tooltip"
                                    data-id='{{ $user[0]->id }}' data-original-title="Delete"><i class="cil-trash"></i>
                                    Delete</a>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                <p class="text-muted">
                                    B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">Malibu, California</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                <p class="text-muted">
                                    <span class="tag tag-danger">UI Design</span>
                                    <span class="tag tag-success">Coding</span>
                                    <span class="tag tag-info">Javascript</span>
                                    <span class="tag tag-warning">PHP</span>
                                    <span class="tag tag-primary">Node.js</span>
                                </p>
                                <hr>
                                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                    fermentum enim neque.</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs" style="font-size: 20px;">
                                    <li class="nav-item"><a class="nav-link active" style="color:#3B4C64!important"
                                            href="#overview" data-toggle="tab"><i class="cil-clipboard"></i> Overview</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" style="color:#3B4C64!important" href="#invite"
                                            data-toggle="tab"><i class="cil-cursor"></i> Invite</a></li>
                                    <li class="nav-item"><a class="nav-link" style="color:#3B4C64!important"
                                            href="#assessment" data-toggle="tab"><i class="cil-graph"></i> Assessment</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" style="color:#3B4C64!important"
                                            href="#settings" data-toggle="tab"><i class="cil-vertical-align-bottom1"></i>
                                            Talent map</a></li>
                                </ul>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="overview">
                                        <div class="row">
                                            <div class="col-sm-8 col-md-8">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Talent map</h4>
                                                    </div>
                                                    <div class="card-body row">
                                                        <div class="wrapper col-md-6">
                                                            <h2 class="how-title">Skills</h2>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Risk Management</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-success"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="25" aria-valuemin="0"
                                                                            aria-valuemax="100">25%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Strategic Planning</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-success"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="56" aria-valuemin="0"
                                                                            aria-valuemax="100">56%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Analytical Thinking</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-success"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="87" aria-valuemin="0"
                                                                            aria-valuemax="100">87%</div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- end of /.coloumn -->
                                                        <div class="wrapper col-md-6">
                                                            <h2 class="how-title">Occupations</h2>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Horticulturalist</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-warning"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="25" aria-valuemin="0"
                                                                            aria-valuemax="100">25%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Travel Agent</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-warning"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="56" aria-valuemin="0"
                                                                            aria-valuemax="100">56%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Network Administration</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-warning"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="87" aria-valuemin="0"
                                                                            aria-valuemax="100">87%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end of /.coloumn -->

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-md-4">
                                                <div class="card">
                                                    <div class="card-header">Card title</div>
                                                    <div class="card-body">Lorem ipsum dolor sit amet, consectetuer
                                                        adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
                                                        dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                                                        quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                                        aliquip ex ea commodo consequat.</div>
                                                </div>
                                            </div>

                                            <div class="col-sm-8 col-md-8">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Profile</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="c100 p90 blue">
                                                            <span data-toggle="modal"
                                                                data-target="#basicExampleModal"><strong style="color: #3B4C64; cursor: pointer;">90%</strong></span>
                                                            <div class="slice">
                                                                <div class="bar"></div>
                                                                <div class="fill"></div>
                                                            </div>
                                                        </div>

                                                        <div class="c100 p15 green">
                                                            <span data-toggle="modal"
                                                                data-target="#basicExampleModal"><strong style="color: #3B4C64; cursor: pointer;">15%</strong></span>
                                                            <div class="slice">
                                                                <div class="bar"></div>
                                                                <div class="fill"></div>
                                                            </div>
                                                        </div>

                                                        <div class="c100 p74 orange">
                                                            <span data-toggle="modal"
                                                                data-target="#basicExampleModal"><strong style="color: #3B4C64; cursor: pointer;">74%</strong></span>
                                                            <div class="slice">
                                                                <div class="bar"></div>
                                                                <div class="fill"></div>
                                                            </div>
                                                        </div>
                                                     <h4><span class="badge badge-primary">Social</span></h4>
                                                    </div>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicExampleModal" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title" id="exampleModalLabel">
                                                                        <strong>Professional Profile 2</strong>
                                                                    </h3>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-5">
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center m-auto">
                                                                                <div>
                                                                                    <div
                                                                                        class="chart-wrapper row align-items-center justify-content-center">
                                                                                        <div class="c100 p90 blue">
                                                                                            <span><strong style="color: #3B4C64; cursor: pointer;">90%</strong></span>
                                                                                            <div class="slice">
                                                                                                <div class="bar"></div>
                                                                                                <div class="fill"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="text-center ml-1 mb-1 mt-1">
                                                                                        <div
                                                                                            class="synthetic-box-label-donuts badge text-white p-2 red-background">
                                                                                            Social </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-sm-7">
                                                                            <div>Social individuals are gregarious by nature
                                                                                and have the need to belong to a group. They
                                                                                enjoy networking and can easily form good
                                                                                professional and personal bonds with others.
                                                                                They enjoy working in teams and tend to
                                                                                spread their enthusiasm to their
                                                                                team-members. As a result, they integrate
                                                                                very easily into different teams.</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="invite">
                                        <div id="accordion" class="myaccordion">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h2 class="mb-0">
                                                        <button
                                                            class="d-flex align-items-center justify-content-between btn btn-link"
                                                            data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            Undergraduate Studies
                                                            <span class="fa-stack fa-sm">
                                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                                <i class="fas fa-minus fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                        <ul>
                                                            <li>Computer Science</li>
                                                            <li>Economics</li>
                                                            <li>Sociology</li>
                                                            <li>Nursing</li>
                                                            <li>English</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <h2 class="mb-0">
                                                        <button
                                                            class="d-flex align-items-center justify-content-between btn btn-link collapsed"
                                                            data-toggle="collapse" data-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            Postgraduate Studies
                                                            <span class="fa-stack fa-2x">
                                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                                <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                        <ul>
                                                            <li>Informatics</li>
                                                            <li>Mathematics</li>
                                                            <li>Greek</li>
                                                            <li>Biostatistics</li>
                                                            <li>English</li>
                                                            <li>Nursing</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                    <h2 class="mb-0">
                                                        <button
                                                            class="d-flex align-items-center justify-content-between btn btn-link collapsed"
                                                            data-toggle="collapse" data-target="#collapseThree"
                                                            aria-expanded="false" aria-controls="collapseThree">
                                                            Research
                                                            <span class="fa-stack fa-2x">
                                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                                <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                        <ul>
                                                            <li>Astrophysics</li>
                                                            <li>Informatics</li>
                                                            <li>Criminology</li>
                                                            <li>Economics</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="assessment">
                                        <fieldset class="responsive" style="border:none; ">
                                            <div class="col-sm-4">
                                                <div class="box">
                                                    <div class="lead">
                                                        <i class="fa fa-sign-in ec-title-text-color"></i> Authentication
                                                    </div>
                                                    <small class="text-muted">
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-sm-7 col-sm-offset-1">

                                                <p class="responsive">
                                                    <i title="Authentication url" class="fa fa-link"></i>
                                                    https://app.centraltest.com/united-management-consulting/auth-participant
                                                    <br>
                                                    Username: <strong>tdanzansod4970440.daba</strong>
                                                    <br>
                                                    Password: <strong>***********</strong>
                                                    <br>
                                                </p>
                                            </div>
                                        </fieldset>

                                        <div class="form-group">
                                            <select id='status' class="form-control" style="width: 200px">
                                                <option value="">--Select Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                        </div>
                                        <table class="table table-bordered yajra-datatable user_table " id="user_table">
                                            <thead>
                                                <tr>
                                                    <th width="3px"><input type="checkbox" id="selectAll" /></th>
                                                    <th width="5px">#</th>
                                                    <th>Тест нэр</th>
                                                    <th>Evaluator</th>
                                                    <th>Огноо</th>
                                                    <th width="10px">Гүйцэтгэсэн хугацаа</th>
                                                    <th width="400px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('participants.assessment') }}",
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'info',
                    name: 'info'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: "duration",
                    name: "duration",
                    render: function(data) {
                        return "<i class='cil-clock'> " + data + "<i/>";
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true

                },
            ]
        });

    });


    $(document).ready(function() {
        $('body').on('click', '.addToGroup', function() {
            var id = $(this).data('id');
            $('#user_id').val(id);
            $('#groupModal').modal('show');
            // alert(id);
        })
    });

    $(document).ready(function() {
        $(".delete").click(function(e) {
            var id = $(this).data("id");
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Тийм',
                cancelButtonText: 'Үгүй'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "get",
                        url: "/participants/destroy/" + id,
                        success: function(data) {
                            $('#confirmModal').modal('hide');
                            Swal.fire(
                                'Deleted!',
                                'Амжилттай устгагдлаа',
                                'success'
                            )
                            setTimeout(function() {
                                window.history.back();
                            }, 1000);
                        },
                        error: function(data) {
                            alert('Error:', data);
                        }
                    });
                }
            })
            $('#select_all').click(function(event) {
                var $that = $(this);
                $(':checkbox').each(function() {
                    this.checked = $that.is(':checked');
                });
            });


            function addPost() {
                $('#add-group-modal').modal('show');
            }
        });
    });

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
