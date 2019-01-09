@extends('layouts.default.index')
@section('title','Soir Music')
@section('l-content')
<v-container class="pa-0 ma-0" fill-height fluid>
    <v-layout>
        <v-flex>
            <v-img src="https://i.imgur.com/R13SHZd.jpg">
                <v-container class='ma-0 pa-0' fluid>
                        <section>
                        <v-img @click="window.location='/'" src="https://i.imgur.com/Q3Ssf5m.jpg" height="170" contain alt></v-img>
                        <v-flex class="display-3 text-xs-center white--text">Your Music Soaring</v-flex>
                            <v-container class='pa-0'fluid>
                            <v-layout column wrap justify-center v-if="screen==0">
                                    <v-card tile color="transparent">
                                            <v-card-title><v-flex v-if="screen==0" class="display-1 text-xs-center white--text">Our Services</v-flex></v-card-title>
                                            <v-layout row wrap>
                                                <v-flex xs4 v-for='service in services'>
                                                    <v-container fluid fill-height>
                                                        <v-card :color="service.color" :class="service.colortext" width="354" height="100%">
                                                            <v-layout justify-space-between column fill-height>
                                                                <v-flex>
                                                                    <v-card-title primary-title>
                                                                        <h3 class="headline ma-1">@{{service.title}}</h3>
                                                                    </v-card-title>
                                                                    <v-card-text>
                                                                        <v-img :src="service.img" aspect-ratio="2.5"></v-img>
                                                                        <v-flex>@{{service.desc}}</v-flex>
                                                                    </v-card-text>
                                                                </v-flex>
                                                                <v-flex style='height:100px'>
                                                                    <v-layout align-end row fill-height>
                                                                        <v-flex>
                                                                            <v-divider></v-divider>
                                                                            <v-card-actions>
                                                                                <v-btn color="blue darken-3" @click='linkopen(service.sc)' block>View Examples</v-btn>
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
                            </v-container>
                        </section>
                </v-container>
                <v-container class="pa-4 ma-0" v-if="screen=='services'" fluid>
                    <v-layout column wrap>
                        <v-flex>
                            <v-card tile color="white" >
                                <v-toolbar card color="blue darken-3">
                                    <v-flex class="display-2 text-xs-left white--text">@{{scdet.title}}</v-flex>
                                </v-toolbar>
                                <v-layout row wrap>
                                    <v-flex xs9>
                                        <template v-for='sample in scdet.samples'>
                                            <v-flex xs6>@{{sample.name}}
                                                <v-btn fab dark color="blue" small>
                                                    <v-icon dark>play_arrow</v-icon>
                                                </v-btn>
                                            </v-flex>
                                        </template>
                                    </v-flex>
                                    <v-flex xs3>
                                        <v-container fill-height>
                                            <v-flex >
                                                <v-img :src="scdet.img" width="220" height="100"></v-img>
                                                <v-btn color="red" @click="popup=true" round>@{{scdet.submit}}</v-btn>
                                            </v-flex>  
                                        </v-container>
                                    </v-flex>
                                </v-layout>
                                <v-card-action class="text-xs-center">
                                    <v-flex xs12 class='text-xs-center'><v-btn icon color='blue' @click="window.location='/'"><v-icon>home</v-icon></v-btn></v-flex>
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
                                        <v-text-field :rules="rules.name" v-model="form.songname" label="Song Name" required></v-text-field>
                                        <v-text-field :rules="rules.mail" v-model="form.email" label="Your E-Mail" required></v-text-field>
                                        <v-select v-model="form.service" :items="services" item-text="title" item-value="sc" label="Service" persistent-hint required></v-select>
                                        <label>File
                                            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                                        </label>
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
            </v-img>
        </v-flex>
    </v-layout>
</v-container>
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
    new Vue({
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
                file:'',
                form: {name:'',songname:'',email:'',service:'',music:[]},
                popup: false,
                screen: 0,
                scdet: {title:'',samples:'',img:'',submit:''},
                drawer: null,
                rules: {
                    name:[
                        v=> !!v || 'Field is mandatory!',
                    ],
                    email:[
                        v => !!v || 'Your Mail is mandatory!',
                        v => /.+@.+/.test(v) || 'Mail must be in a valid format!',
                    ],
                },
                services: [{
                        sc: 1,
                        color: 'white',
                        colortext: 'black--text',
                        img: "https://cymatics.fm/wp-content/uploads/2017/10/Songwriting-Tips-881x392.jpg",
                        img_scr:"https://i.imgur.com/mnEWYU3.jpg",
                        title: 'Songwriting',
                        desc: "Work side by side with a professional songwriter on developing your artistic image and get personalized songs that translate your unique vision. Whether you’re a Pop, Country, R&B, Rock, Hip-Hop, Jazz, EDM, or any other style of artist, we’re committed to delivering songs you’ll wish you had written yourself.",
                    },
                    {
                        sc: 2,
                        color: 'white',
                        colortext: 'black--text',
                        img: "http://www.thebeachhousestudios.com/wp-content/uploads/2014/01/mixing-board-close.jpg",
                        img_scr:"https://i.imgur.com/PWq7bmx.jpg",
                        title: "Production/\nMixing",
                        desc: "Get your songs fully arranged, produced, mixed and mastered by one of our industry-top sound engineers. Our mission is to enhance your musical ideas through sound design and work according to your guidelines to deliver a completely personalized radio-ready track you’ll be proud to have your name under.",
                    },
                    {
                        sc: 3,
                        color: 'white',
                        colortext: 'black--text',
                        img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRTMiSiojhpRRBkFvagiTQspYIwHNF7HB0Mdz8AHN9EIpM6CQ1",
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
            }
        },
        methods: {
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            notify: function (text, color) {
                this.snackbar_notify.text = text;
                this.snackbar_notify.model = true;
                if (this.snackbar_notify.color == null) this.snackbar_notify.color = "black";
                this.snackbar_notify.color = color;
            },
            submit: function(){
                let formData = new FormData();
                formData.append('file', this.file);
                axios.post( '/submit',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                    ).then(function(){
                    console.log('SUCCESS!!');
                    })
                    .catch(function(){
                    console.log('FAILURE!!');
                    });
            },
            getsamples: function(num){
                return num;
            },
            getscdet: function(num){
                switch (num){
                    case 1:
                        this.scdet={title:'Song Writing', samples:this.getsamples(num), img:this.services[0].img_scr, submit:'Submit your music now!'};
                        break;
                    case 2:
                        this.scdet={title:'Production/Mixing', samples:this.getsamples(num), img:this.services[1].img_scr, submit:'Submit your music now!'};
                        break;
                    case 3:
                        this.scdet={title:'Song Critique', samples:this.getsamples(num), img:this.services[2].img_scr, submit:'Submit your music now!'};
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
@endsection
