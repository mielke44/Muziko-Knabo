@extends('layouts.default.index')
@section('title','Soir Music')
@section('l-content')
<v-container class="pa-0 ma-0" fill-height fluid>
    <v-layout>
        <v-flex>
            <v-img :height="background1" src="https://i.imgur.com/R13SHZd.jpg">
                <v-container class='ma-0 pa-0' fluid>
                    <v-img @click="window.location='/'" src="https://i.imgur.com/6NltwwC.png" :height="logoheight" contain alt></v-img>
                    <v-flex  class="display-3 text-xs-center text">Your Music Soaring</v-flex>
                </v-container>
            </v-img>
            <v-img :height="background2" src="https://i.imgur.com/6m169yS.jpg">
                <v-layout column wrap justify-center v-if="screen==0">
                    <v-card tile color="transparent">
                        <v-card-title><v-flex  class="display-1 text-xs-center white--text text">Our Services</v-flex></v-card-title>
                        <v-layout row wrap>
                            <v-flex class='pl-4' xs4 v-for='service in services'>
                                <v-container fluid fill-height>
                                    <v-card color="rgb(0,0,0,0.2)" width="354" height="100%">
                                        <v-layout justify-space-between column fill-height>
                                            <v-flex>
                                                <v-card-title primary-title>
                                                    <h3 style="font-size: 18pt;" class="ma-1 text2">@{{service.title}}</h3>
                                                </v-card-title>
                                                <v-card-text>
                                                    <v-img :src="service.img" aspect-ratio="3.0"></v-img>
                                                    <v-flex class="text2">@{{service.desc}}</v-flex>
                                                </v-card-text>
                                            </v-flex>
                                            <v-flex style="height:100px;">
                                                <v-layout align-end row fill-height>
                                                    <v-flex>
                                                        <v-divider></v-divider>
                                                        <v-card-actions>
                                                            <v-layout align-center column fill-height>
                                                                <v-btn class="text-xs-center text2  mb-2" color="blue" @click="ask_popup_set" outline round>Got Questions?</v-btn>
                                                                <v-btn class="text-xs-center text2" color="green" @click='linkopen(service.sc);logoheight=350;background1=500;background2=500;' outline round block>View Examples</v-btn>
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
                    </v-card>
                </v-layout>
                <v-container class="pa-4 ma-0" v-if="screen=='services'" fluid>
                    <v-layout column wrap>
                        <v-flex>
                            <v-card tile color="rgb(0, 0, 0, 0.2)">
                                <v-toolbar card color="transparent">
                                    <v-flex class="display-2 text-xs-left white--text text">@{{scdet.title}}</v-flex>
                                </v-toolbar>
                                <v-layout row wrap>
                                    <v-flex xs6>
                                        <template v-for='sample in scdet.samples'>
                                            <v-flex xs6 class="pa-4">@{{sample.name}}
                                                <!-- <v-btn fab dark color="blue" small>
                                                    <v-icon dark>play_arrow</v-icon>
                                                </v-btn> -->
                                                <audio controls>
                                                    <source src="{{URL::asset('Footprints.mp3')}}" type="audio/mpeg">
                                                    <source src="{{URL::asset('Footprints.mp3')}}" type="application/octet-stream">
                                                Your browser does not support the audio element.
                                                </audio>
                                            </v-flex>
                                        </template>
                                    </v-flex>
                                    <v-flex xs6>
                                        <v-layout column align-center justify-center>
                                            <v-img :src="scdet.img" width="220" height="100"></v-img>
                                            <v-btn class="text2" color="blue" @click="popup=true" outline round>@{{scdet.submit}}</v-btn>
                                        </v-layout>
                                    </v-flex>
                                </v-layout>
                                <v-card-action class="text-xs-center">
                                    <v-flex xs12 class='text-xs-center'><v-btn icon color='blue' @click="window.location='/';logoheight=650"><v-icon>home</v-icon></v-btn></v-flex>
                                </v-card-action>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-dialog v-model="popup" max-width="500" r>
                    <v-flex xs12>
                        <v-card>
                            <v-toolbar card color="blue">
                                <v-flex><h3 class="headline mb-0 text-xs-center">Submit</h3></v-flex>
                            </v-toolbar>
                            <v-form ref='form'>
                                <v-card-text>
                                    <v-text-field :rules="rules.name" v-model="form.name" label="Artist Name" required></v-text-field>
                                    <v-text-field :rules="rules.songname" v-model="form.songname" label="Song Name"></v-text-field>
                                    <v-text-field :rules="rules.email" v-model="form.email" label="Your E-Mail" required></v-text-field>
                                    <v-select :rules="rules.name" v-model="form.service" :items="services" item-text="title" item-value="sc" label="Service" persistent-hint required></v-select>
                                    <label>File
                                        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                                    </label>
                                    <v-flex class="text-xs-center" color="light-grey">Accepted audio extensions: au, snd, mid, rmi, mp3, mp4, wav</v-flex>
                                    <v-flex class="text-xs-center" color="light-grey">Max file size: 10MB</v-flex>
                                    <v-spacer></v-spacer>
                                    <v-divider></v-divider>
                                    <v-flex class="text-xs-center" color="light-grey">* submitting your song will only ensure that it will be considered by our team.
                                                                                    In case of acceptance, you'll receive an e-mail within a few days along with rates. Good Luck!</v-flex>
                                </v-card-text>
                            </v-form>
                            <v-card-actions>
                                <v-flex xs12 class='text-xs-center'><v-btn  color='blue' @click='submit'>Submit!</v-btn></v-flex>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-dialog>
                <v-dialog v-model="ask_popup" max-width="500" r>
                        <v-flex xs12>
                            <v-card>
                                <v-toolbar card color="blue">
                                    <v-flex><h3 class="headline mb-0 text-xs-center">Ask your question!</h3></v-flex>
                                </v-toolbar>
                                <v-form ref='form'>
                                    <v-card-text>
                                        <v-flex class="text-xs-center" color="light-grey">"Got questions? Our A&R team will be happy to go over them with you"</v-flex>
                                        <v-text-field :rules="rules.name" v-model="form.name" label="Your Name" required></v-text-field>
                                        <v-text-field :rules="rules.email" v-model="form.email" label="Your E-Mail" required></v-text-field>
                                        <v-textarea :rules="rules.name" v-model="form.question" label="question" required></v-textarea>
                                    </v-card-text>
                                </v-form>
                                <v-card-actions>
                                    <v-flex xs12 class='text-xs-center'><v-btn  color='blue' @click='submit_question'>Submit!</v-btn></v-flex>
                                </v-card-actions>
                            </v-card>
                        </v-flex>
                    </v-dialog>
            </v-img>
        </v-flex>
    </v-layout>
</v-container>

<!--SNACKBAR NOTIFY-->
<v-snackbar v-model="snackbar_notify.model" multi-line timeout="3000" bottom right :color='snackbar_notify.color'>
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
@endsection

@section('l-footer')
<v-card class="flex" flat tile>

    <v-card-actions class="grey darken-3 justify-center">
        <div><span class="white--text">2019 — <strong>Soir Music&copy; by Bruno Rios</strong></span></div>

    </v-card-actions>
</v-card>
@endsection

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
                ask_popup: false,
                background1:100,
                background2:950,
                logoheight:650,
                file:'',
                form: {name:'',songname:'',email:'',service:''},
                popup: false,
                screen: 0,
                scdet: {title:'',samples:'',img:'',submit:''},
                drawer: null,
                rules: {
                    name:[
                        v => !!v || 'Field is mandatory!'
                    ],
                    songname:[
                        v => !!v || 'If no name has been chosen, use "undecided"!'
                    ],
                    email:[
                        v => !!v || 'Your Mail is mandatory!',
                        v => /.+@.+/.test(v) || 'Mail must be a valid format!'
                    ]
                },
                services: [{
                        sc: 1,
                        color: 'white',
                        colortext: 'black--text',
                        img: "https://i.imgur.com/mnEWYU3.jpg",
                        img_scr:"https://i.imgur.com/KXwOiUk.jpg",
                        title: 'Songwriting',
                        desc: "Work side by side with a professional songwriter on developing your artistic image and get personalized songs that translate your unique vision. Whether you’re a Pop, Country, R&B, Rock, Hip-Hop, Jazz, EDM, or any other style of artist, we’re committed to delivering songs you’ll wish you had written yourself.",
                    },
                    {
                        sc: 2,
                        color: 'white',
                        colortext: 'black--text',
                        img: "https://i.imgur.com/oX2Vy0W.jpg",
                        img_scr:"https://i.imgur.com/PWq7bmx.jpg",
                        title: "Production/\nMixing",
                        desc: "Get your songs fully arranged, produced, mixed and mastered by one of our industry-top sound engineers. Our mission is to enhance your musical ideas through sound design and work according to your guidelines to deliver a completely personalized radio-ready track you’ll be proud to have your name under.",
                    },
                    {
                        sc: 3,
                        color: 'white',
                        colortext: 'black--text',
                        img: "https://i.imgur.com/kF63ioC.jpg",
                        img_scr:"https://i.imgur.com/1Qge5ZV.jpg",
                        title: 'Song Critique',
                        desc: "Are you tired of getting feedback like “it’s so cool”, “I like it” or “sounds a little off” from your friends and family? Have your music dissected note by note and word by word by both professional songwriters and producers to know exactly what’s working, what could use a second look and how to bring it closer to the sounds you hear in your head.",
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
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            ask_popup_set: function(){
                this.form={
                    name:"",
                    email:"",
                    question:"",
                }
            },
            submit_question: function(){
                app.confirm("Submitting your Question", "Confirm?", "blue", () => {
                    $.ajax({
                        url: "{{route('submitquestion')}}",
                        method: "POST",
                        dataType: 'json',
                        headers: $('meta[name="csrf-token"]').attr('content'),
                    }).done(response => {
                        this.notify("Question sent successfully!","green");
                    }).error(reponse =>{
                        this.notify("An error occurred! Please try again!","red");
                    })
                })
            },
            notify: function(text, color) {
                this.snackbar_notify.text = text;
                this.snackbar_notify.model = true;
                this.snackbar_notify.color = color;
                if(this.snackbar_notify.color == null) this.snackbar_notify.color = "black";
            },
            confirm: function (title, text, color, action) {
                this.dialog_confirm.model = true;
                this.dialog_confirm.title = title;
                this.dialog_confirm.text = text;
                this.dialog_confirm.color = color;
                this.dialog_confirm.action = action;
            },
            submit: function(){
                let formData = new FormData();
                if(this.$refs.form.validate()){
                    formData.append('file', this.file);
                    formData.append('name',this.form.name);
                    formData.append('email',this.form.email);
                    formData.append('songname',this.form.songname);
                    formData.append('service',this.form.service);
                    app.confirm("Submitting your data", "Confirm?", "blue", () => {
                        axios.post('/submit',
                            formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            }).then(response=>{
                            this.popup=false;
                            this.form={name:'',songname:'',email:'',service:''};
                            this.notify("DONE! You'll receive a response e-mail from our experts ASAP!", "green");
                            })
                            .catch(response=>{
                            this.notify('An Error Occurred! Please try again!','red');
                            });
                    })
                }
            },
            getsamples: function(num){
                return num;
            },
            getscdet: function(num){
                switch (num){
                    case 1:
                        this.scdet={title:'Song Writing', samples:this.getsamples(num), img:this.services[0].img_scr, submit:'sign up for a free consultation'};
                        break;
                    case 2:
                        this.scdet={title:'Production/Mixing', samples:this.getsamples(num), img:this.services[1].img_scr, submit:'sign up for a free consultation'};
                        break;
                    case 3:
                        this.scdet={title:'Song Critique', samples:this.getsamples(num), img:this.services[2].img_scr, submit:'sign up for a free consultation'};
                        break;
                }
            },
            linkopen: function (scnum) {
                this.getscdet(scnum);
                this.screen='services';
                
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
.zeroblur{
    filter: blur(0px);
}
.text {
    -webkit-text-stroke: 1px black;
    color: white;
    text-shadow:
        3px 3px 0 #000,
        -1px -1px 0 #000,  
        1px -1px 0 #000,
        -1px 1px 0 #000,
        1px 1px 0 #000;
}
.text2 {
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

</style>

@endsection