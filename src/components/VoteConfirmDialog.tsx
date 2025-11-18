import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
} from "@/components/ui/alert-dialog";
import { Candidate } from "@/pages/Voting";

interface VoteConfirmDialogProps {
  open: boolean;
  onOpenChange: (open: boolean) => void;
  candidate: Candidate | null;
  onConfirm: () => void;
}

const VoteConfirmDialog = ({ open, onOpenChange, candidate, onConfirm }: VoteConfirmDialogProps) => {
  if (!candidate) return null;

  return (
    <AlertDialog open={open} onOpenChange={onOpenChange}>
      <AlertDialogContent className="rounded-[20px]">
        <AlertDialogHeader>
          <AlertDialogTitle className="text-2xl">Konfirmasi Pilihan</AlertDialogTitle>
          <AlertDialogDescription className="text-base space-y-2">
            <p>Kamu yakin memilih pasangan nomor <strong>{candidate.number}</strong>?</p>
            <p className="font-semibold text-foreground">
              {candidate.president} & {candidate.vicePresident}
            </p>
            <p className="text-destructive font-medium">
              Pilihan tidak bisa diubah setelah dikonfirmasi.
            </p>
          </AlertDialogDescription>
        </AlertDialogHeader>
        <AlertDialogFooter>
          <AlertDialogCancel className="rounded-xl">Batal</AlertDialogCancel>
          <AlertDialogAction 
            onClick={onConfirm}
            className="rounded-xl gradient-primary hover:opacity-90"
          >
            Ya, Saya Yakin
          </AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>
  );
};

export default VoteConfirmDialog;
