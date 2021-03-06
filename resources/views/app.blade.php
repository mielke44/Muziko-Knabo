@extends('layouts.default.index')
@section('title','Soir Music')
@section('l-content')
@section('css')
<link href="{{asset('Fonts/Style.css')}}" rel="stylesheet" type="text/css"/>
@endsection
<v-container class="pa-0 ma-0" fill-height fluid>
    <v-layout>
        <v-flex>
            <v-img :height="background1" src="storage/Samples/images/background1.jpg">
                <v-container class='ma-0 pa-0' fluid>
                    <v-img @click="window.location='/'" src="storage/Samples/images/logo.png" :height="logoheight"
                        contain alt></v-img>
                </v-container>
            </v-img>
            <v-img  src="storage/Samples/images/background2.jpg">
                <v-flex class="text-xs-center text-font2-title">Your Music Soaring</v-flex>
                <v-layout column wrap justify-center v-if="screen==0">
                    <v-card flat tile color="transparent">
                        <v-card-title>
                            <v-flex class="text-xs-center text-font1-subheader">Our Services</v-flex>
                        </v-card-title>
                        <v-layout :column="$vuetify.breakpoint.xsOnly" row wrap>
                            <v-flex  v-for='service in services'>
                                <v-container class='pa-0 mb-3' justify-center fluid fill-height>
                                    <v-card style="background-color: rgba(0,0,0,0.6);" width="354" height="100%">
                                        <v-layout justify-space-between column fill-height>
                                            <v-flex>
                                                <v-card-title primary-title>
                                                    <h3 class=" text-font1-subheader">@{{service.title}}</h3>
                                                </v-card-title>
                                                <v-card-text>
                                                    <v-img :src="service.img" aspect-ratio="3.0"></v-img>
                                                    <v-flex class="text-font1">@{{service.desc}}</v-flex>
                                                </v-card-text>
                                            </v-flex>
                                            <v-flex style="height:100px;">
                                                <v-layout align-end row fill-height>
                                                    <v-flex>
                                                        <v-divider></v-divider>
                                                        <v-card-actions>
                                                            <v-layout align-center column fill-height>
                                                                <v-btn class="text-xs-center text-font1  mb-2" color="white"
                                                                    @click="ask_popup_set" outline round>Got Questions?</v-btn>
                                                                <v-btn class="text-xs-center text-font1" color="blue"
                                                                    @click='linkopen(service.sc);logoheight=350;background1=500;'
                                                                    outline round block>View Examples</v-btn>
                                                            </v-layout>
                                                        </v-card-actions>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-card>
                                </v-container>
                            </v-flex>
                        </v-layout>
                        <v-flex class="mt-3 text-xs-center text-font1">Couldn't find the service you're looking for? Tell us what you want, we'll be happy to adapt our skills to your needs!</v-flex>
                    </v-card>
                </v-layout>
                <v-container class="pa-0 ma-0" v-if="screen=='services'" fluid align-center justify-center>
                    <v-layout class="pa-0 ma-0" column wrap>
                        <v-flex>
                            <v-card tile style="background-color: rgba(0,0,0,0.6);">
                                <v-card-title>
                                    <v-toolbar card color="transparent">
                                        <v-flex class="text-xs-center text-font1-subheader">@{{scdet.title}}</v-flex>
                                    </v-toolbar>
                                </v-card-title>
                                <v-layout :column="$vuetify.breakpoint.xsOnly" align-center justify-center row wrap>
                                    <v-flex class="text-xs-center text-font1-subheader">Examples:
                                        <template v-if='screen_type==1'>
                                                <v-layout column wrap>
                                                    <v-template v-for="sample in scdet.samples">
                                                        <v-flex xs12 class="text-xs-center pa-2 text-font1">@{{sample.name}}</v-flex>
                                                        <v-flex class="pl-2">
                                                            <audio class="pa-2" controls>
                                                                <source :src="sample.url" type="audio/wav">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        </v-flex>
                                                    </v-template>
                                                </v-layout>
                                        </template>
                                        <template v-if='screen_type==2'>
                                                <v-layout column wrap>
                                                    <v-template v-for="sample in scdet.samples">
                                                        <v-flex xs12 class="text-xs-center pa-2 text-font1">@{{sample.name}}</v-flex>
                                                        <v-flex class="pl-2">
                                                            <audio class="pa-2" controls>
                                                                <source :src="sample.url" type="audio/wav">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        </v-flex>
                                                    </v-template>
                                                </v-layout>
                                        </template>
                                        <template v-if="screen_type==3">
                                                <v-layout column wrap>
                                                    <v-template v-for="sample in scdet.samples">
                                                        <v-flex xs12 class="text-xs-center pa-2 text-font1">@{{sample.name}}</v-flex>
                                                        <v-flex class="pl-2">
                                                            <audio class="pa-2" controls>
                                                                <source :src="sample.url" type="audio/wav">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        </v-flex>
                                                    </v-template>
                                                    <v-flex  class="text-xs-center text-font1" @Click="song_popup=true">Click here for analysis examples!</v-flex>
                                                    <v-dialog  overflow v-model="song_popup" max-width="600" r>
                                                        <v-card style="background-color: transparent;">
                                                            <v-flex class="text-xs-center">
                                                                <v-img src="storage/Samples/images/analysis4.png"></v-img>
                                                                <v-img src="storage/Samples/images/analysis2.png"></v-img>
                                                                <v-img src="storage/Samples/images/analysis3.png"></v-img>
                                                                <v-img src="storage/Samples/images/analysis1.png"></v-img>
                                                            </v-flex>
                                                            <v-flex  class="text-xs-center">
                                                                <v-btn color="blue"  @click="song_popup=false" icon>
                                                                    <v-icon>close</v-icon>
                                                                </v-btn>
                                                            </v-flex>
                                                        </v-card>
                                                    </v-dialog>
                                                </v-layout>
                                        </template>
                                    </v-flex>
                                    <v-divider color="white" :inset="!$vuetify.breakpoint.xsOnly" :vertical="!$vuetify.breakpoint.xsOnly"></v-divider>
                                    <v-flex v-if="$vuetify.breakpoint.xsOnly" xs4 pa-4 class="text-font-spaced text-xs-center">@{{scdet.details}}
                                    </v-flex>
                                    <v-flex xs4>
                                        <v-card flat class="text-xs-center" v-if="!$vuetify.breakpoint.xsOnly" color="transparent">
                                            <v-card-text class="text-font-spaced">
                                                @{{scdet.details}}
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>
                                    <v-divider color="white" :inset="!$vuetify.breakpoint.xsOnly" :vertical="!$vuetify.breakpoint.xsOnly"></v-divider>
                                    <v-flex xs4 class="pr-2 text-xs-center">
                                        <v-layout class="pt-3 mt-3 pb-5" column align-center justify-center fill-heigth>
                                            <v-img class="mb-5" :src="scdet.img" width="250" height="200"></v-img>
                                            <v-btn class="text-font1" color="blue" @click="popup=true" outline round>@{{scdet.submit}}</v-btn>
                                            <v-btn class="text-font1" color="yellow darken-3" @click="ratings=true" outline round>Rate our website and services!</v-btn>
                                        </v-layout>
                                        <v-flex class="text-font1-subheader text-xs-center">Latest user ratings:</v-flex>
                                        <v-list v-if="ratesless.length>0" three-line style="background-color: rgba(0,0,0,0.0);">
                                            <v-list-tile v-for="item in ratesless">
                                                <v-list-tile-content>
                                                    <v-layout row wrap>
                                                        <v-list-tile-title class="text-font1" v-text="item.name"></v-list-tile-title>
                                                        <v-list-tile-subtitle>
                                                            <v-flex class="text-font1-list-subheader">@{{item.comment}}</v-flex>
                                                            <v-rating dense small v-model="item.rate" color="yellow darken-3" background-color="white" empty-icon="$vuetify.icons.ratingFull" readonly></v-rating>
                                                        </v-list-tile-subtitle>
                                                    </v-layout>
                                                </v-list-tile-content>
                                                <v-list-tile-action-text>
                                                    <v-flex class="text-xs-center text-font1-list-subheader">@{{item.created}}</v-flex>
                                                </v-list-tile-action-text>
                                            </v-list-tile>
                                        </v-list>
                                        <v-flex v-if="ratesless.length>0" class='text-xs-center text-font1'>
                                            <v-btn outline round color="yellow darken-3" @click="allrates=true">See all</v-btn>
                                        </v-flex>
                                        <v-flex v-if="ratesless.length==0" class="text-xs-center text-font1">No ratings so far! Be the first to rate this service!</v-flex>
                                    </v-flex>
                                </v-layout>
                                <v-divider class="pa-3 pb-3" :inset="!$vuetify.breakpoint.xsOnly" ></v-divider>
                                <v-card-action class="text-xs-center">
                                    <v-flex xs12 class='text-xs-center'>
                                        <v-btn icon color='blue' @click="window.location='/';logoheight=650">
                                            <v-icon>home</v-icon>
                                        </v-btn>
                                    </v-flex>
                                </v-card-action>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-card>
                        <v-flex class="text-xs-center text-font1 pr-2">Couldn't find the service you're looking for? Tell us what you want, we'll be happy to adapt our skills to your needs!</v-flex>
                    </v-card>
                    </v-container>
                <v-dialog v-model="popup" max-width="500" r>
                    <v-flex xs12>
                        <v-card>
                            <v-toolbar card color="blue">
                                <v-flex>
                                    <h3 class="headline mb-0 text-xs-center">Submit</h3>
                                </v-flex>
                            </v-toolbar>
                            <v-form ref='form'>
                                <v-card-text>
                                    <v-text-field :rules="rules.name" v-model="form.name" label="Your Artist Name" required></v-text-field>
                                    <v-text-field :rules="rules.songname" v-model="form.songname" label="Your Song Name"></v-text-field>
                                    <v-text-field :rules="rules.email" v-model="form.email" label="Your E-Mail"
                                        required></v-text-field>
                                    <v-select :rules="rules.name" v-model="form.service" :items="services" item-text="title"
                                        item-value="sc" label="Service" persistent-hint required></v-select>
                                    <v-flex class="text-xs-center" color="light-grey">Send us links to songs you'd like to use as a reference</v-flex>
                                    <v-text-field v-model="form.refs" label="Reference links"></v-text-field>
                                    <label>File
                                        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" />
                                    </label>
                                    <v-flex class="text-xs-center" color="light-grey">Accepted audio extensions: au,
                                        snd, mid, rmi, mp3, mp4, wav</v-flex>
                                    <v-flex class="text-xs-center" color="light-grey">Max file size:@{{maxFileSize}}</v-flex>
                                    <v-spacer></v-spacer>
                                    <v-divider></v-divider>
                                    <v-flex class="text-xs-center" color="light-grey">* submitting your song will only
                                        ensure that it will be considered by our team.
                                        In case of acceptance, you'll receive an e-mail within a few days along with
                                        rates. Good Luck!</v-flex>
                                </v-card-text>
                            </v-form>
                            <v-card-actions>
                                <v-flex xs12 class='text-xs-center'>
                                    <v-btn color='blue' @click='submit'>Submit!</v-btn>
                                </v-flex>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-dialog>
                <v-dialog v-model="ask_popup" max-width="500" r>
                    <v-flex xs12>
                        <v-card>
                            <v-toolbar card color="blue">
                                <v-flex>
                                    <h3 class="headline mb-0 text-xs-center">Ask us a question!</h3>
                                </v-flex>
                            </v-toolbar>
                            <v-form ref='form'>
                                <v-card-text>
                                    <v-flex class="text-xs-center" color="light-grey">Got questions? Our A&R team will
                                        be happy to go over them with you</v-flex>
                                    <v-text-field :rules="rules.name" v-model="form.name" label="Your Name" required></v-text-field>
                                    <v-text-field :rules="rules.email" v-model="form.email" label="Your E-Mail"
                                        required></v-text-field>
                                    <v-textarea :rules="rules.name" v-model="form.question" label="question" required></v-textarea>
                                </v-card-text>
                            </v-form>
                            <v-card-actions>
                                <v-flex xs12 class='text-xs-center'>
                                    <v-btn color='blue' @click='submit_question'>Submit!</v-btn>
                                </v-flex>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-dialog>
                <v-dialog v-model="ratings" max-width="500" r>
                    <v-flex xs12>
                        <v-card>
                            <v-toolbar card color="blue">
                                <v-flex>
                                    <h3 class="headline mb-0 text-xs-center">Rate us!</h3>
                                </v-flex>
                            </v-toolbar>
                            <v-form ref='rate'>
                                <v-card-text>
                                    <v-flex class="text-xs-center" color="light-grey">How did you like our website? Suggestions to make it better?</v-flex>
                                    <v-text-field :rules="rules.name" v-model="form.name" label="Your Name" required></v-text-field>
                                    <v-textarea counter='150' :rules="rules.comment" v-model="form.rate" label="Your opinion" required></v-textarea>
                                    <v-layout column align-center>
                                    <v-flex class="text-xs-center" color="light-grey">How likely are you to recommend our website?</v-flex>
                                        <v-rating v-model="form.rating" color="yellow darken-3" background-color="grey darken-1" empty-icon="$vuetify.icons.ratingFull" hover></v-rating>
                                    </v-layout>
                                </v-card-text>
                            </v-form>
                            <v-card-actions>
                                <v-flex xs12 class='text-xs-center'>
                                    <v-btn color='blue' @click='submit_rating(scdet.title)'>Submit!</v-btn>
                                </v-flex>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-dialog>
                <v-dialog v-model="allrates" max-width="500" r>
                        <v-flex xs12>
                            <v-card style="background-color: rgba(255,255,255,1);">
                                <v-toolbar card color="blue">
                                    <v-flex>
                                        <h3 class="headline mb-0 text-xs-center">All Ratings</h3>
                                    </v-flex>
                                </v-toolbar>
                                <v-list two-line>
                                    <v-list-tile v-for="item in ratesfull" :key="item.name">
                                        <v-list-tile-content>
                                            <v-layout row wrap>
                                                <v-list-tile-title v-text="item.name"></v-list-tile-title>
                                                <v-list-tile-subtitle>
                                                    <v-flex style="font-size: 10pt" v-text="item.comment"></v-flex>
                                                    <v-rating dense small v-model="item.rate" color="yellow darken-3" background-color="light-grey" empty-icon="$vuetify.icons.ratingFull" half-increments readonly></v-rating>
                                                </v-list-tile-subtitle>
                                            </v-layout>
                                        </v-list-tile-content>
                                        <v-list-tile-action-text>
                                            <v-flex class="text-xs-center text-font1-list-subheader">@{{item.created}}</v-flex>
                                        </v-list-tile-action-text>
                                    </v-list-tile>
                                </v-list>
                                <v-card-actions>
                                    <v-flex xs12 class='text-xs-center'>
                                        <v-btn color='blue' @click="allrates=false">Close</v-btn>
                                    </v-flex>
                                </v-card-actions>
                            </v-card>
                        </v-flex>
                    </v-dialog>
            </v-img>
        </v-flex>
    </v-layout>
</v-container>

<!--SNACKBAR NOTIFY-->
<v-snackbar v-model="snackbar_notify.model" multi-line timeout="9000" bottom right :color='snackbar_notify.color'>
    @{{snackbar_notify.text}}
    <v-btn flat @click.native="snackbar_notify.model = false">
        <v-icon>clear</v-icon>
    </v-btn>
</v-snackbar>

<!--CONFIRM/CHECK DIALOG-->
<v-dialog v-model="dialog_confirm.model" persistent max-width="500px" transition="dialog-transition">
    <v-card :color='dialog_confirm.color' dark>
        <v-card-text class='text-xs-center display-1'>
            @{{dialog_confirm.title}}
        </v-card-text>
        <v-divider></v-divider>
        <v-card-text class='text-xs-center'>
            @{{dialog_confirm.text}}
        </v-card-text>
        <v-divider></v-divider>
        <v-card-text class='text-xs-center'>
            <v-btn color="white" class='red--text' @click='dialog_confirm.model=false' fab small>
                <v-icon large>close</v-icon>
            </v-btn>
            <v-btn color="white" class='green--text' @click='dialog_confirm.action();dialog_confirm.model=false' fab
                small>
                <v-icon large>check</v-icon>
            </v-btn>
            </v-card-tex>
    </v-card>
</v-dialog>

<!--LOADER DIALOG-->
<v-dialog v-model="loader" persistent max-width="500px" transition="dialog-transition">
    <v-card color='blue' dark>
        <v-card-text class='text-xs-center'>
            loading...
            <v-progress-linear
                indeterminate
                color="white"
                class="mb-0"
            ></v-progress-linear>
        </v-card-text>
    </v-card>
</v-dialog>
@endsection

@section('l-footer')
<v-card class="flex" flat tile>
    <v-card-actions class="grey darken-3 justify-center">
        <div><span class="white--text">2019 — <strong>Soir Music&copy; by Bruno Rios</strong></span></div>
    </v-card-actions>
</v-card>
@endsection
<!--FIRST WORKING COMMIT VERSION 1.0 BY WILSON MIELKE-->
@section('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    app = new Vue({
        el: '#app',
        created() {
            this.$vuetify.theme = {
                primary: '#424242',
                secondary: '#424242',
                accent: '#82B1FF',
                error: '#ff4444',
                info: '#33b5e5',
                success: '#00C851',
                warning: '#ffbb33'
            };
        },
        data() {
            return {
                allrates:false,
                ratesless:[],
                ratesfull:[],
                ratings:false,
                loader:false,
                screen_type:0,
                ask_popup: false,
                background1: 650,
                logoheight: 650,
                song_popup:false,
                maxFileSize:'',
                file: '',
                form: {
                    name: '',
                    songname: '',
                    email: '',
                    service: '',
                    refs: '',
                    rate:'',
                    rating:'',
                },
                popup: false,
                screen:0,
                scdet: {},
                drawer: null,
                rules: {
                    name: [
                        v => !!v || 'Field is mandatory!'
                    ],
                    comment:[
                        v => !!v || 'Field is mandatory!',
                    ],
                    songname: [
                        v => !!v || 'If no name has been chosen, use "undecided"!'
                    ],
                    email: [
                        v => !!v || 'Your Mail is mandatory!',
                        v => /.+@.+/.test(v) || 'Mail must be a valid format!'
                    ]
                },
                services: [
                    {
                        sc: 1,
                        color: 'white',
                        colortext: 'black--text',
                        img: "storage/Samples/images/firstpage_SW.jpg",
                        img_scr: "storage/Samples/images/secondpage_SW.jpg",
                        title: 'Songwriting',
                        details:"Work side by side with professional writers on developing a personalized song-concept and have experts working within your guidelines in order to build songs that translate your unique artistic vision and image. Our goal is to deliver music that translates everything you feel but can’t quite put into words or melodies, we don’t just want to write songs, we want to write YOUR songs.",
                        desc:"Work side by side with a professional songwriter on developing your artistic image and get personalized songs that translate your unique vision. Whether you’re a Pop, Country, R&B, Rock, Hip-Hop, Jazz, EDM, or any other style of artist, we’re committed to delivering songs you’ll wish you had written yourself.",
                    },
                    {
                        sc: 2,
                        color: 'white',
                        colortext: 'black--text',
                        img: "storage/Samples/images/firstpage_PM.jpg",
                        img_scr: "storage/Samples/images/secondpage_PM.jpg",
                        title: "Production/\nMixing",
                        details:"Wanna hear your music sound crystal-clear and as professional as you hear on the radio? Our producers and sound engineers are experts in building effective arrangements, mixing and mastering your songs in order to make them sound exactly as you hear in your head. Our mission is to enhance your musicality through sound-design and deliver cohesive and professional radio-ready tracks.",
                        desc:"Get your songs fully arranged, produced, mixed and mastered by one of our industry-top sound engineers. Our mission is to enhance your musical ideas through sound design and work according to your guidelines to deliver a completely personalized radio-ready track you’ll be proud to have your name under.",
                    },
                    {
                        sc: 3,
                        color: 'white',
                        colortext: 'black--text',
                        img: "storage/Samples/images/firstpage_AN.jpg",
                        img_scr: "storage/Samples/images/firstpage_AN.jpg",
                        title: 'Song Critique',
                        details:"Motific development, melodic contrast, prosody, internal repetition, varied rhyme-schemes… these are just some of the techniques present in most of the hit songs over the last decades. Would you like a professional songwriter to go over your music note by note and word by word and break apart the secrets of how to make it even more effective? We’re here to help you bring your music to the next level and provide you with detailed straight-forward feedback on specific ways to improve your writing and become a hit-writer yourself.",
                        desc:"Are you tired of getting feedback like “it’s so cool”, “I like it” or “sounds a little off” from your friends and family? Have your music dissected note by note and word by word by both professional songwriters and producers to know exactly what’s working, what could use a second look and how to bring it closer to the sounds you hear in your head.",
                    }
                ],
                snackbar_notify: {
                    text: "",
                    model: false,
                    color: "",
                },
                dialog_confirm: {
                    model: false,
                    color: 'white',
                    title: '',
                    text: '',
                    action: () => {},
                }
            }
        },
        methods: {
            handleFileUpload() {
                this.file = this.$refs.file.files[0];
            },
            ask_popup_set: function () {
                this.form = {
                    name: "",
                    email: "",
                    question: "",
                }
                this.ask_popup = true;
            },
            submit_question: function () {
                app.confirm("Submitting your Question", "Confirm?", "blue", () => {
                    this.loader=true;
                    $.ajax({
                        url: '{{route("submitquestion")}}',
                        method: 'POST',
                        dataType: 'json',
                        data: this.form,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:(response) => {
                            this.loader=false;
                            this.notify("Question sent successfully!", "green");
                            this.ask_popup = false;
                        },
                        error:(response) => {
                            this.notify("An error occurred! Please try again!", "red");
                        }
                    })
                })
            },
            submit_rating: function (service) {
                app.confirm("Submitting your ratings", "Confirm?", "blue", () => {
                    this.loader=true;
                    $.ajax({
                        url: '{{route("submitrating")}}',
                        method: 'POST',
                        dataType: 'json',
                        data: {form:this.form,service:service},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:(response) => {
                            this.loader=false;
                            this.notify("Thank you for rating us!", "green");
                            this.ratings = false;
                            this.getrates(service);
                        },
                        error:(response) => {
                            this.notify("An error occurred! Please try again!", "red");
                        }
                    })
                })
            },
            notify: function (text, color) {
                this.snackbar_notify.text = text;
                this.snackbar_notify.model = true;
                this.snackbar_notify.color = color;
                if (this.snackbar_notify.color == null) this.snackbar_notify.color = "black";
            },
            confirm: function (title, text, color, action) {
                this.dialog_confirm.model = true;
                this.dialog_confirm.title = title;
                this.dialog_confirm.text = text;
                this.dialog_confirm.color = color;
                this.dialog_confirm.action = action;
            },
            submit: function () {
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('name', this.form.name);
                formData.append('email', this.form.email);
                formData.append('songname', this.form.songname);
                formData.append('service', this.form.service);
                formData.append('refs', this.form.refs);
                app.confirm("Submitting your data", "Confirm?", "blue", () => {
                    this.loader=true;
                    axios.post('/submit',
                            formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            }).then(response => {
                                this.loader=false;
                                if(response['data']['error'])this.notify(response['data']['message'],'red')
                                else{
                                this.popup = false;
                                this.form = {name: '',songname: '',email: '',service: ''};
                                this.notify(
                                    "DONE! You'll receive a response e-mail from our experts ASAP!",
                                    "green");
                                }
                        })
                        .catch(response => {
                            this.loader=false;
                            console.log(JSON.stringify(response['response']['status']))
                            if(JSON.stringify(response['response']['status'])=='413')this.notify("File Size is larger than accepted!","red")
                            else this.notify('An Error Occurred! Please try again!', 'red');
                        });
                })
            },
            getscdet: function (num) {
                switch (num) {
                    case 1:
                        this.scdet = {
                            title: 'Songwriting',
                            details: this.services[0].details,
                            img: this.services[0].img_scr,
                            submit: 'sign up for a free consultation',
                            samples:[],
                        };
                        break;
                    case 2:
                        this.scdet = {
                            title: 'Production/Mixing',
                            details: this.services[1].details,
                            img: this.services[1].img_scr,
                            submit: 'sign up for a free consultation',
                            samples:[],
                        };
                        break;
                    case 3:
                        this.scdet = {
                            title: 'Song Critique',
                            details: this.services[2].details,
                            img: this.services[2].img_scr,
                            submit: 'sign up for a free consultation',
                            samples:[],
                        };
                        break;
                }
            },
            getSamples:function(num){
                $.ajax({
                        url: '{{route("samples")}}',
                        method: 'GET',
                        dataType: 'json',
                        data: {num:num},
                        success:(response) => {
                            this.scdet.samples = response;
                        },
                        error:(response) => {
                            this.notify("An error occurred! Please try again!", "red");
                        }
                    })
            },
            getSize:function(){
                $.ajax({
                        url: '{{route("filesize")}}',
                        method: 'GET',
                        dataType: 'json',
                        success:(response) => {
                            this.maxFileSize = response;
                        },
                        error:(response) => {
                            this.notify('An error occured, please refresh!', "red");
                        }
                    })
            },
            getrates:function(num){
                $.ajax({
                        url: '{{route("rates")}}',
                        method: 'GET',
                        dataType: 'json',
                        data: {num:num},
                        success:(response) => {
                            if(response!='no rates'){
                                this.ratesfull = response;
                                if(response.length<2){
                                    this.ratesless = [response[0]];
                                    if(response[0]['comment'].length>35)this.ratesless =[];
                                }else{
                                    for(rate of response){
                                        if(rate.comment.length<35 && this.ratesless.length<3){
                                            var ArrayIndex=response.indexOf(rate);
                                            if(response.length!=ArrayIndex)this.ratesless.push(rate);
                                        }
                                    }
                                }
                            }
                        },
                        error:(response) => {
                            this.notify("An error occurred! Please try again!", "red");
                        }
                    })
            },
            linkopen: function (scnum) {
                this.getrates(scnum)
                this.getscdet(scnum);
                this.getSamples(scnum);
                this.getSize();
                this.screen = 'services';
                this.screen_type=scnum;
            },
        },
        mounted() {
            var self = this;
        }
    });
</script>
<style>
    .blur {
        filter: blur(5px);
    }
    .zeroblur {
        filter: blur(0px);
    }
    .text-font1{
        font-family:Museo Sans W01_500;
        -webkit-text-stroke: 0.1px black;
        color: white;
        display: block;
        text-align: justify;
        text-justify: inter-word;
        text-shadow:
            1px 1px 0 #000,
            -1px -1px 0 #000,
            1px -1px 0 #000,
            -1px 1px 0 #000,
            1px 1px 0 #000;
        font-size: 14pt;
    }
    .text-font1-list-subheader{
        font-family:Museo Sans W01_500;
        -webkit-text-stroke: 0.1px black;
        color: lightgray;
        display: block;
        text-align: justify;
        text-justify: inter-word;
        text-shadow:
            1px 1px 0 #000,
            -1px -1px 0 #000,
            1px -1px 0 #000,
            -1px 1px 0 #000,
            1px 1px 0 #000;
        font-size: 10pt;
    }
    .text-font-spaced{
        font-family:Museo Sans W01_500;
        display: block;
        text-align: justify;
        text-justify: inter-word;
        line-height: 2.5;
        -webkit-text-stroke: 0.1px black;
        color: white;
        text-shadow:
            1px 1px 0 #000,
            -1px -1px 0 #000,
            1px -1px 0 #000,
            -1px 1px 0 #000,
            1px 1px 0 #000;
        font-size: 14pt;
    }
    .text-font1-subheader{
        font-family:Museo Sans W01_500;
        -webkit-text-stroke: 0.5px black;
        color: white;
        text-shadow:
            1px 1px 0 #000,
            -1px -1px 0 #000,
            1px -1px 0 #000,
            -1px 1px 0 #000,
            1px 1px 0 #000;
        font-size: 26pt;
    }
    .text-font2-title{
        font-family:Ethnocentric W05 Regular;
        font-size:42pt;
        -webkit-text-stroke: 1px black;
        color: white;
        text-shadow:
            3px 3px 0 #000,
            -1px -1px 0 #000,
            1px -1px 0 #000,
            -1px 1px 0 #000,
            1px 1px 0 #000;
}
</style>

@endsection