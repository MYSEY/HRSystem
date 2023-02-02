<!-- field_type_name -->
@php
    $setRequired = $field['setRequired'] ?? 4;
@endphp
<!-- field_type_name -->
<div class="form-group col-md-12">
    <div class="row" id="address-{{ $field['name'] }}">
        <div class="col-sm-6 col-md-6 mb-3">
            <label>Province/City</label>
            <select class="form-control" @change="cityChange" v-model="frm.city" :disabled="JSON.stringify(cities).length==2">
                <option v-for="(item, text) in cities" :value="text">@{{item}}</option>
            </select>
        </div>
        <div class="col-sm-6 col-md-6">
            <label>District/Khan</label>
            <select class="form-control" @change="districChange" v-model="frm.distric" :disabled="JSON.stringify(districs).length==2">
                <option v-for="(item, text) in districs" :value="text">@{{item}}</option>
            </select>
        </div>
        <div class="col-sm-6 col-md-6">
            <label class="no-error-label">Commune/Sangkat</label>
            <select class="form-control no-error-border" @change="communeChange" v-model="frm.commune" :disabled="JSON.stringify(communes).length==2">
                <option v-for="(item, text) in communes" :value="text">@{{item}}</option>
            </select>
        </div>
        <div class="col-sm-6 col-md-6">
            <label class="no-error-label">Village</label>
            <select class="form-control no-error-border" @change="villageChange" v-model="frm.village" :disabled="JSON.stringify(villages).length==2">
                <option v-for="(item, text) in villages" :value="text">@{{item}}</option>
            </select>
        </div>  
        <input type="hidden" v-model="hidden" name="{{ $field['name'] }}">
    </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>

@push('after_styles')
    <!-- no styles -->
    {{-- Remove style and class when enable all field show error --}}
    <style>
        .label-required { color:#ff0000; }
        .no-error-border { border-color: #d2d6de !important; }
        .no-error-label { color: #333 !important; }
    </style>
@endpush

@push('after_scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    var appAddress = new Vue({
        el: '#address-{{ $field['name'] }}',
        data() {
            return{
                cities:{},
                districs:{},
                communes:{},
                villages:{},
                frm:{},
                hidden:"{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"
            }
        },
        methods:{
            cityChange: async function(){
                var me = this;
                this.hidden = this.frm.city;
                await this.getData(this.frm.city).then(function(response){
                    me.districs = response.data;
                    me.communes={};
                    me.villages={};
                });
            },
            districChange: async function(){
                var me = this;
                this.hidden = this.frm.distric;
                await this.getData(this.frm.distric).then(function(response){
                    me.communes = response.data;
                    me.villages={};
                });
            },
            communeChange: async function(){
                var me = this;
                this.hidden = this.frm.commune;
                await this.getData(this.frm.commune).then(function(response){
                    me.villages = response.data;
                });
            },
            villageChange:function(){
                this.hidden = this.frm.village;
            },
            getData:function(code=''){
                if(code){ 
                    return axios.get('{{route("address.index")}}?code='+code)
                }
                else
                { 
                    return axios.get('{{route("address.index")}}')
                }
            }
        },
        created: async function(){
            var me = this;
            this.getData().then(function(response){
               me.cities = response.data;
            });

            if(this.hidden.length>1){
                var str = this.hidden;
                var take = 2;
                var i = 1;

                do {
                    var res = str.substring(0, take*i);
                    if(i==1){
                        this.frm.city=res;
                        await this.cityChange();
                    }
                    if(i==2){
                        this.frm.distric=res;
                        await this.districChange();
                    }
                    if(i==3){
                        this.frm.commune=res;
                        await this.communeChange();
                    }
                    if(i==4){
                        this.frm.village=res;
                        await this.villageChange();
                    }
                    i++;
                } while (res!=str);
            }
        }
    });
</script>

@endpush

