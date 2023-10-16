<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\Blood;
use App\Models\emp_job;
use App\Models\Vacancy;
use App\Models\emp_education;
use App\Models\Gender;
use App\Models\emp_addressl;
use App\Models\nrc;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;


class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                forms\components\Wizard::make([
                    forms\components\Wizard\Step::make('Employee Info')
                        ->schema([
                            TextInput::make('emp_ename')->label('English Name')->required(),
                            TextInput::make('emp_mname')->label('Myanmar Name')->required(),
                            TextInput::make('emp_fname')->label('Father Name')->required(),
                            DatePicker::make('emp_datebirth')->required(),
                            TextInput::make('emp_race')->label('Race')->required(),

                            Select::make('emp_religion')
                            ->label('Religion')
                            ->options([
                                'Buddhist' => 'Buddhist',
                                'Christian' => 'Christian',
                                'Hindu' => 'Hindu',
                                'Islam' => 'Islam',
                                'Jewish' => 'Jewish',
                                'Muslim' => 'Muslim',
                                'No religion' => 'No religion',
                            ])
                            ->required()
                            ->searchable(),

                            Select::make('emp_nationality')
                            ->label('nationality')
                            ->options([
                                'Myanmar' => 'Myanmar',
                                'foreign' => 'foreign',
                            ])
                            ->required()
                            ->searchable(),

                            Select::make('emp_vacancy')
                            ->required()
                            ->options(Vacancy::all()->pluck('name'))
                            ->searchable()->label('Vacancy'),

                            TextInput::make('emp_passportno')->label('Passport No')->required(),

                            Fieldset::make('')
                             ->schema([
                            TextInput::make('emp_driverlicense')->label('Driver License')->columnspan(5)->required(),

                            Select::make('nrcs_id')
                            ->label('NRC')
                            ->required()
                            ->options(nrc::select('nrc_code')->distinct()->orderBy('nrc_code', 'asc')->pluck('nrc_code'))
                            ->live()
                            ->required()
                            ->afterStateUpdated(fn($set, ?string $state) => $set('name_en',
                            nrc::select('name_en')->where('nrc_code', ++$state)->pluck('name_en'))),

                            Select::make('nrcs_n')
                              ->label('distinct')
                              ->required()
                              ->options(function ($get) {
                                  return $get('name_en');}),

                            Select::make('emp_naing')
                            ->label('(နိုင်)')
                            ->required()
                                        ->options([
                                            '(နိုင်)' => '(နိုင်)',
                                            '(ပြု)' => '(ပြု)',
                                            '(ဧည့်)' => '(ဧည့်)',
                                        ]),
                            TextInput::make('emp_number')->label('number')->columnspan(2)->required(),

                             Select::make('emp_gender')
                             ->required()
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                                'Other' => 'Other',
                            ])
                            ->label('Gender')->columnspan(5),

                             ])->columns(15),



                            Select::make('emp_blood')
                            ->required()
                            ->options([
                                'A+' => 'A+',
                                'A-' => 'A-',
                                'B+' => 'B+',
                                'B-' => 'B-',
                                'AB+' => 'AB+',
                                'AB-' => 'AB-',
                                'O+' => 'O+',
                                'O-' => 'O-',
                            ])
                            ->required()
                            ->searchable()->label('Blood'),
                            Select::make('emp_martial')
                            ->required()
                            ->options([
                                'Single' => 'Single',
                                'Married' => 'Married',
                                'Divorced' => 'Divorced',
                                'Widowed' => 'Widowed',
                                'Life Partner' => 'Life Partner',
                                'Other' => 'Other',
                            ])
                            ->label('Maritial Status'),
                            TextInput::make('emp_hphone')->label('Home Phone')->required(),
                            TextInput::make('emp_Mphone')->label('Mobile Phone')->required(),
                            TextInput::make('emp_space')->columnspan(2)->required(),
                            FileUpload::make('emp_folder')->columnspan(2) ->panelAspectRatio('8:0')->required(),



                        ])->columns(3),

                    forms\components\Wizard\Step::make('Background Info')
                        ->schema([

                        Repeater::make('education')
                        ->relationship()
                        ->schema([
                            // CheckboxList::make('emp_checke')
                            // ->label('Check')
                            //     // ->options([
                            //     //     'emp_checke' => 'Education info',
                            //     // ])
                            //     ->columnspan('full'),
                            TextInput::make('emp_education')->required()
                            ->label('Education/Degree')->columnspan(2),
                            DatePicker::make('emp_frome')->label('From')->required(),
                            DatePicker::make('emp_toe')->label('To')->required(),
                            TextInput::make('emp_school')->label('School/Colleage/University')->columnspan(2)->required(),
                        ])->columns(6),
                        Repeater::make('job')
                        ->relationship()
                        ->schema([
                            // CheckboxList::make('emp_checkw')
                            //     ->label('Check')
                            //     // ->options([
                            //     //     'emp_checkw' => 'Working Experience',
                            //     // ])
                                // ->columnspan('full'),
                                TextInput::make('emp_job')->label('Job Title')->columnspan(2)->required(),
                                TextInput::make('emp_companyn')->label('Company Name')->columnspan(2)->required(),
                                DatePicker::make('emp_fromec')->label('From')->required(),
                                DatePicker::make('emp_toc')->label('To')->required(),
                                TextInput::make('emp_contactc')->label('Contact')->columnspan(2)->required(),
                                TextInput::make('emp_addressc')->label('Address')->columnspan(4)->required(),
                        ])->columns(6),
                        Fieldset::make('')
                        ->schema([
                            FileUpload::make('emp_folder2')->columnspan(4)->label('')->required(),
                        ])->columns(6),
                        Fieldset::make('Reference person')
                        ->schema([
                            // CheckboxList::make('emp_checkr')
                            // ->label('Check')
                            // // ->options([
                            // //     'emp_checkr' => 'Reference Person',
                            // // ])
                            // ->columnspan('full'),
                            TextInput::make('emp_refname')->label('Reference Person Name')->required(),
                            TextInput::make('emp_refjob')->label('Job Position')->required(),
                            TextInput::make('emp_refemail')->label('Email')->required(),
                            TextInput::make('emp_refphone')->label('Phone')->required(),

                        ])->columns(4),
                        Fieldset::make('Family member name')
                        ->schema([
                            // CheckboxList::make('emp_checkfm')
                            // ->label('Check')
                            // // ->options([
                            // //     'emp_checkfm' => 'Family Member Name',
                            // // ])
                            // ->columnspan('full'),
                            TextInput::make('emp_familymname')->label('Family Member Name')->required(),
                            TextInput::make('emp_familymrs')->label('Relationship')->required(),
                            DatePicker::make('emp_familydateofbirth')->label('Date of Birth')->required(),
                            TextInput::make('emp_familyoc')->label('Occupation')->required(),
                            TextInput::make('emp_familycontact')->label('Contact Phone No'),
                            TextInput::make('emp_familyaddress')->label('Contact Address')->columnspan(3)->required(),
                        ])->columns(4),


                        Fieldset::make('Tax payer')
                        ->schema([
                            // CheckboxList::make('emp_checkt')
                            // ->label('Check')
                            // // ->options([
                            // //     'emp_checkt' => 'Tax Payer',
                            // // ])
                            // ->columnspan('full'),
                            TextInput::make('emp_temp')->label('Employer'),
                        ])->columns(4),


                        ]),
                    forms\components\Wizard\Step::make('Address')
                        ->schema([
                            Repeater::make('address')
                            ->relationship()
                            ->schema([

                                Select::make('emp_country')
                                ->required()
                                ->options([
                                    'Myanmar' => 'Myanmar',
                                    'other' => 'other',
                                ])
                                ->searchable()->label('Country'),
                                // TextInput::make('emp_country')->label('Country'),
                                // TextInput::make('emp_state')->label('State'),
                                Select::make('emp_state')
                                ->required()
                                ->options([
                                    'Shan' => 'Shan',
                                    'Rakhine' => 'Rakhine',
                                    'Kachin' => 'Kachin',
                                    'Kayah' => 'Kayah',
                                    'Chin' => 'Chin',
                                    'Kayin' => 'Kayin',
                                    'Mon' => 'Mon',
                                    'Bago' => 'Bago',
                                    'Mandalay' => 'Mandaly',
                                    'Sagain' => 'Sagain',
                                    'Ayeyarwady' => 'Ayeyarwady',
                                    'Yangon' => 'Yangon',
                                    'Tanintharyi' => 'Tanintharyi',
                                    'Magway' => 'Magway',
                                ])
                                ->searchable()->label('State'),
                                TextInput::make('emp_township')->label('Township')->required(),
                                TextInput::make('emp_street')->label('Street Address')->required(),
                            ])->columns(4),
                        ]),
                    ]),
                        ])->columns('full');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

            TextColumn::make('emp_ename')->label('Employee Name'),
            TextCOlumn::make('emp_fname')->label('Father Name'),
            TextColumn::make('emp_datebirth')->label('Date of Birth'),
            TextColumn::make('emp_nationality')->label('Nationality'),
            TextColumn::make('emp_religion')->label('Religion'),
            TextColumn::make('emp_vacancy')->label('Vacancy'),
            TextColumn::make('emp_blood')->label('Blood Type'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
