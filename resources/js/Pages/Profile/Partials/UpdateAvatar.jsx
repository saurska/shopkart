import { useRef } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import { useForm,usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import TextInput from '@/Components/TextInput';

export default function UpdateAvatar({ className = '' }) {
    const user = usePage().props.auth.user;
    const imagePath = "/storage/" + user.avatar;
    const fileInputRef = useRef(null);
    const {data, setData, errors, post, reset, processing, recentlySuccessful } = useForm({
        avatar :null
    });

    const updateAvatar = (e) => {
        e.preventDefault();

        post(route('avatar.update'));
    };
    
    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">Your Avatar</h2>
                <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Let your individuality shine with a click – upload your unique avatar and paint your digital canvas!
                </p>
            </header>
            <img src={imagePath} alt="avatar" className='mt-4 h-24  w-24 rounded-full'/>
            <form onSubmit={updateAvatar} className="mt-6 space-y-6"  encType="multipart/form-data">
                <div>
                    <InputLabel htmlFor="avatar" value="avatar" />
                    <TextInput
                        ref={fileInputRef}
                        type="file"
                        id="avatar"
                        name="avatar"
                        className="mt-1 block w-full"
                        onChange= {(e) => setData('avatar', e.target.files[0])}
                    />
                    <InputError message={errors.avatar} className="mt-2" />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>
                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
